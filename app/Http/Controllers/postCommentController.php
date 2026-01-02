<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\postComments;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class postCommentController extends Controller
{
       public function store(Request $request, $postID)
    {
        $form = $request->validate([
            'comment_content' => 'nullable|string',
            'comment_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'parent_comment_id' => 'nullable|exists:post_comments,postcommentID',
        ]);

        // Find the post
        $post = Posts::where('postID', $postID)
            ->firstOrFail();

        // Check if user is authenticated
        if (Auth::guard('guest')->check()) {
            $user = Auth::guard('guest')->user();
            $form['commenterID'] = $user->guestID;
            $form['commenter_role'] = 'Guest';
        
        } elseif (Auth::check()) {
            $user = Auth::user();
            $form['commenter_role'] = 'Admin';
        } else {
            return back()->withErrors([
                'auth' => 'You must be logged in to comment.'
            ]);
        }

        // Handle image upload
        if ($request->hasFile('comment_image')) {
            $file = $request->file('comment_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'images/comments/' . $filename;

            $file->move(public_path('images/comments'), $filename);

            $form['comment_image'] = $path;
        }

        // Set post ID
        $form['postID'] = $postID;

        // Create comment
        postComments::create($form);

      
       

        return back()->with('success', 'Comment posted successfully!');
    }

    public function destroy($postID, $commentID)
{
    $comment = postComments::where('postID', $postID)
        ->where('postcommentID', $commentID)
        ->firstOrFail();

    // Check authorization
    if (Auth::guard('guest')->check()) {
        // Guest can only delete their own comments
        if ($comment->commenter_role !== 'Guest' || $comment->commenterID !== Auth::guard('guest')->user()->guestID) {
            return back()->withErrors([
                'auth' => 'You are not authorized to delete this comment.'
            ]);
        }
    } elseif (Auth::check()) {
        // Admin can delete any comment
        // No additional check needed
    } else {
        return back()->withErrors([
            'auth' => 'You must be logged in to delete a comment.'
        ]);
    }

    // Delete image if exists
    if ($comment->comment_photo && File::exists(public_path($comment->comment_photo))) {
        File::delete(public_path($comment->comment_photo));
    }

   
 
    // Delete comment
    $comment->delete();

    // Update post comment count
  
    return back()->with('success', 'Comment deleted successfully!');
}

}
