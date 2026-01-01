<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function store(Request $request)
    {
        $form = $request->validate([
            'post_content' => 'nullable|string',
            'post_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp,gif',
            'post_video'   => 'nullable|mimes:mp4,webm,mov|max:20480',
        ]);

        // Prevent image + video together
        if ($request->hasFile('post_image') && $request->hasFile('post_video')) {
            return back()->withErrors([
                'media' => 'Please upload only an image or a video.'
            ]);
        }

        // Image upload
        if ($request->hasFile('post_image')) {
            $file = $request->file('post_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'images/posts/' . $filename;

            $file->move(public_path('images/posts'), $filename);

            $form['post_image'] = $path;
            $form['post_video'] = null;
        }

        // Video upload
        if ($request->hasFile('post_video')) {
            $file = $request->file('post_video');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'videos/posts/' . $filename;

            $file->move(public_path('videos/posts'), $filename);

            $form['post_video'] = $path;
            $form['post_image'] = null;
        }

        $form['guestID'] = Auth::guard('guest')->user()->guestID;

        Posts::create($form);

        return back()->with('success', 'Post created successfully!');
    }

    /* =========================
       UPDATE
    ========================= */
 public function update(Request $request, $postID)
{
    $post = Posts::where('postID', $postID)
        ->where('guestID', Auth::guard('guest')->user()->guestID)
        ->firstOrFail();

    $form = $request->validate([
        'post_content' => 'nullable|string',
        'post_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:10240',
        'post_video'   => 'nullable|mimes:mp4,webm,mov|max:20480',
        'keep_current_media' => 'nullable|boolean',
    ]);

    // Prevent image + video together
    if ($request->hasFile('post_image') && $request->hasFile('post_video')) {
        return back()->withErrors([
            'media' => 'Please upload only an image or a video.'
        ]);
    }

    // -----------------------------
    // HANDLE IMAGE UPLOAD
    // -----------------------------
    if ($request->hasFile('post_image')) {
        // Delete old video if exists
        if ($post->post_video && File::exists(public_path($post->post_video))) {
            File::delete(public_path($post->post_video));
        }

        // Delete old image only if it exists (we will replace it)
        if ($post->post_image && File::exists(public_path($post->post_image))) {
            File::delete(public_path($post->post_image));
        }

        $file = $request->file('post_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = 'images/posts/' . $filename;

        $file->move(public_path('images/posts'), $filename);

        $form['post_image'] = $path;
        $form['post_video'] = null;
    }
    // -----------------------------
    // HANDLE VIDEO UPLOAD
    // -----------------------------
    elseif ($request->hasFile('post_video')) {
        // Delete old image if exists
        if ($post->post_image && File::exists(public_path($post->post_image))) {
            File::delete(public_path($post->post_image));
        }

        // Delete old video if exists (we will replace it)
        if ($post->post_video && File::exists(public_path($post->post_video))) {
            File::delete(public_path($post->post_video));
        }

        $file = $request->file('post_video');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = 'videos/posts/' . $filename;

        $file->move(public_path('videos/posts'), $filename);

        $form['post_video'] = $path;
        $form['post_image'] = null;
    }
    // -----------------------------
    // HANDLE KEEP OR REMOVE CURRENT MEDIA
    // -----------------------------
    else {
        // If user clicked "Remove" in modal
        if ($request->input('keep_current_media') == '0') {
            // Delete old image if exists
            if ($post->post_image && File::exists(public_path($post->post_image))) {
                File::delete(public_path($post->post_image));
            }
            // Delete old video if exists
            if ($post->post_video && File::exists(public_path($post->post_video))) {
                File::delete(public_path($post->post_video));
            }

            $form['post_image'] = null;
            $form['post_video'] = null;
        } else {
            // Keep current media, don't modify
            unset($form['post_image'], $form['post_video']);
        }
    }

    $post->update($form);

    return back()->with('success', 'Post updated successfully!');
}
    /* =========================
       DELETE
    ========================= */
    public function destroy($postID)
    {
        $post = Posts::where('postID', $postID)
            ->where('guestID', Auth::guard('guest')->user()->guestID)
            ->firstOrFail();

        // delete media
        if ($post->post_image && File::exists(public_path($post->post_image))) {
            File::delete(public_path($post->post_image));
        }

        if ($post->post_video && File::exists(public_path($post->post_video))) {
            File::delete(public_path($post->post_video));
        }

        $post->delete();

        return back()->with('success', 'Post deleted successfully!');
    }




}
