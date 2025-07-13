<?php

namespace App\Http\Controllers;

use App\Models\additionalRoom;
use Illuminate\Http\Request;
use App\Models\room;
use Termwind\Components\Raw;


class roomController extends Controller
{

     // Configuration arrays as public properties
     public $roomTypes = ['Standard', 'Deluxe', 'Suite', 'Executive'];
    public $roomSizes = ['Small' => 200, 'Medium' => 300, 'Large' => 400, 'XLarge' => 500];
    public $featuresKeywords = [
        'wifi' => 'Free WiFi',
        'tv' => 'Flat-screen TV',
        'ac' => 'Air Conditioning',
        'minibar' => 'Mini Bar',
        'balcony' => 'Balcony',
        'view' => 'City View',
        'safe' => 'In-room Safe',
        'bathtub' => 'Bathtub'
    ];

    public function processRoomPrompt(Request $request)
    {
        $request->validate([
            'ai_prompt' => 'required|string'
        ]);

        try {
            $lowerPrompt = strtolower($request->ai_prompt);

            // Room Type
            $roomType = 'Standard';
            foreach ($this->roomTypes as $type) {
                if (strpos($lowerPrompt, strtolower($type)) !== false) {
                    $roomType = $type;
                    break;
                }
            }

            // Room Size
            $roomSize = 300;
            foreach ($this->roomSizes as $size => $sqft) {
                if (strpos($lowerPrompt, strtolower($size)) !== false) {
                    $roomSize = $sqft;
                    break;
                }
            }

            // Max Guests
            $maxGuests = 2;
            if (preg_match('/(\d+)\s*(guest|person|people)/i', $request->ai_prompt, $matches)) {
                $maxGuests = (int)$matches[1];
            }

            // Features
            $features = [];
            foreach ($this->featuresKeywords as $key => $feature) {
                if (strpos($lowerPrompt, $key) !== false) {
                    $features[] = $feature;
                }
            }
            $features = empty($features) ? 'Free WiFi, Air Conditioning' : implode(', ', $features);

            // Price
            $price = 1500;
            if (preg_match('/(\d+)\s*(peso|php|₱|price|rate)/i', $request->ai_prompt, $matches)) {
                $price = (int)$matches[1];
            } elseif (preg_match('/\b(\d{3,4})\b/', $request->ai_prompt, $matches)) {
                $price = (int)$matches[1];
            }

            // Description
            $description = "Our $roomType room features " . strtolower($features) . ". " .
                           "This " . strtolower($roomType) . " accommodation is perfect for your stay.";

            // Final data to pass to view
            $roomData = [
                'roomtype' => $roomType,
                'roomsize' => $roomSize,
                'roommaxguest' => $maxGuests,
                'roomfeatures' => $features,
                'roomdescription' => $description,
                'roomprice' => $price,
                'roomstatus' => 'Available',
                'roomphoto' => 'images/defaults/default.jpg'
            ];

            room::create($roomData);

             session()->flash('roomcreated', 'Room Has Been Added');

             return redirect()->back();



        } catch (\Exception $e) {
            return back()->with('error', 'The prompt could not be processed. Please try again.');
        }
        
    }

    
     

    public function store(Request $request){
        $form = $request->validate([
            'roomtype' => 'required',
            'roomsize' => 'required',
            'roommaxguest' => 'required',
            'roomfeatures' => 'required',
            'roomdescription' => 'required',
            'roomphoto' => 'required',
            'roomprice' => 'required',
            'roomstatus' => 'required',
        ]);

        

        $filename = time(). '_' . $request->file('roomphoto')->getClientOriginalName();
        $filepath = 'images/rooms/' .$filename;
        $request->file('roomphoto')->move(public_path('images/rooms/'), $filename);
        $form['roomphoto'] = $filepath;

        room::create($form);

        session()->flash('roomcreated', 'Room Has Been Added');

        return redirect()->back();
    }

    public function delete(Request $request, room $roomID){
        $roomID->delete();

        session()->flash('roomdeleted', 'Room Has Been Deleted');

        return redirect()->back();
    }

    public function modify(Request $request, room $roomID){
          $form = $request->validate([
            'roomtype' => 'nullable',
            'roomsize' => 'nullable',
            'roomaxguest' => 'nullable',
            'roomfeatures' => 'nullable',
            'roomdescription' => 'nullable',
            'roomphoto' => 'nullable',
            'roomprice' => 'nullable',
             'roomstatus' => 'nullable',
        ]);

        if($request->hasFile('roomphoto')){
            $filename = time(). '_' . $request->file('roomphoto')->getClientOriginalName();
            $filepath = 'images/rooms/' .$filename;
            $request->file('roomphoto')->move(public_path('images/rooms/'), $filename);
            $form['roomphoto'] = $filepath;
        }
        else{
             $form['roomphoto'] = $roomID->roomphoto;
        }

        

        $roomID->update($form);

        session()->flash('roommodify', 'Room Has been Modified');

        return redirect()->back();


    }

    public function redirect($roomID){

        $room = room::where('roomID', $roomID)->first();
        $roomphotos = additionalRoom::
        join('core1_room', 'core1_room.roomID', '=', 'core1_roomphotos.roomID')
        ->where('core1_roomphotos.roomID', $roomID)
        ->latest('core1_roomphotos.created_at')
        ->get();

        return view('admin.roompage', ['room' => $room, 'roomphotos' => $roomphotos]);
    }

    public function addphoto(Request $request){
        $form = $request->validate([
            'roomID' => 'required',
            'additionalroomphoto' => 'required',
        ]);

        $filename = time(). '_' .$request->file('additionalroomphoto')->getClientOriginalName();
        $filepath = 'images/rooms/' .$filename;
        $request->file('additionalroomphoto')->move(public_path('images/rooms/'), $filename);
        $form['additionalroomphoto'] = $filepath;

        additionalRoom::create([
            'roomID' => $form['roomID'],
            'additionalroomphoto' => $form['additionalroomphoto'],
        ]);

        session()->flash('photoadded', 'Additional Photo for this Room Has Been Added');

        return redirect()->back();
    }

    public function deleteroomphoto(additionalRoom $roomphotoID){
        $roomphotoID->delete();

         session()->flash('photoremoved', 'Photo Has Been Removed');

        return redirect()->back();
    }


    
}
