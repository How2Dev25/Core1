<?php

namespace App\Http\Controllers;

use App\Models\guestRatings;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class ratingController extends Controller
{
    public function store(Request $request){

       $form = $request->validate([
    'rating_name'        => 'required|string|max:255',
    'rating_email'       => 'nullable|email|max:255', // was ration_email
    'rating_description' => 'required|string',
    'rating_rating'      => 'required|integer|min:1|max:5',
    'rating_location' => 'required|string|max:255', // make optional (or change to required if you want)
]);
        guestRatings::create($form);

       return redirect()->to(url()->previous() . '#reviews')
    ->with('success', 'Thanks for your review!');
    }


    public function delete(guestRatings $ratingID){
            $ratingID->delete();

            return redirect()->back()->with('success', 'Feedback Has Been Removed');
    }
}
