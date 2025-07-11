<?php

namespace App\Http\Controllers;

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

        session()->flash('roomadd', 'Room Has Been Added');

        return redirect()->back();
    }

    public function delete(Request $request, room $roomID){
        $roomID->delete();

        session()->flash('roomdelete', 'Room Has Been Deleted');

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

        return redirect()->back();


    }

    public function redirect($roomID){

        $room = room::where('roomID', $roomID)->first();

        return view('admin.roompage', ['room' => $room]);
    }
}
