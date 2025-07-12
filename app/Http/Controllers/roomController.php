<?php

namespace App\Http\Controllers;

use App\Models\additionalRoom;
use Illuminate\Http\Request;
use App\Models\room;
use Termwind\Components\Raw;

class roomController extends Controller
{
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
