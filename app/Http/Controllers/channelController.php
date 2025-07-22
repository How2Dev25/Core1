<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class channelController extends Controller
{
    public function store(Request $request){
        $form = $request->validate([
            'roomID' => 'required',
            'channelName' => 'required',
        ]);

        $form['channelStatus'] = 'Pending';

        Channel::create($form);

        session()->flash('RoomAdded',' Listing is added And is waiting for approval');

        return redirect()->back();

    }

    public function modify(Request $request, Channel $channelID){
         $form = $request->validate([
            'roomID' => 'nullable',
            'channelName' => 'nullable',
            
        ]);

        $channelID->update($form);

        session()->flash('RoomModify','Listing Has Been Modified');

        return redirect()->back();
    }

    public function delete(Channel $channelID){

        $channelID->delete();

         session()->flash('RoomDelete','Listing Has Been Removed');

        return redirect()->back();
    }
}
