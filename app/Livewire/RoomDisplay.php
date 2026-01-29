<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\room;
use App\Models\roomtypes;
use Illuminate\Support\Facades\DB;

class RoomDisplay extends Component
{
    public function render()
    {
        $allowedRoomTypes = roomtypes::pluck('roomtype_name')->toArray();

        // Get room types with available room counts and sample photos
        $roomTypesWithCounts = room::query()
            ->select('roomtype', DB::raw('count(*) as available_count'))
            ->where('roomstatus', 'Available')
            ->whereIn('roomtype', $allowedRoomTypes)
            ->groupBy('roomtype')
            ->orderBy('roomtype')
            ->get();

        // Get a random room photo for each type
        foreach ($roomTypesWithCounts as $roomType) {
            $sampleRoom = room::where('roomtype', $roomType->roomtype)
                ->where('roomstatus', 'Available')
                ->inRandomOrder()
                ->first();
            
            $roomType->sample_photo = $sampleRoom ? $sampleRoom->roomphoto : null;
            $roomType->sample_price = $sampleRoom ? $sampleRoom->roomprice : null;
            $roomType->sample_size = $sampleRoom ? $sampleRoom->roomsize : null;
            $roomType->sample_maxguest = $sampleRoom ? $sampleRoom->roommaxguest : null;
            $roomType->sample_features = $sampleRoom ? $sampleRoom->roomfeatures : null;
        }

        return view('livewire.room-display', [
            'roomTypesWithCounts' => $roomTypesWithCounts,
        ]);
    }

    /**
     * Get a random available room of the specified type
     */
    public function selectRoomType($roomType)
    {
        $availableRoom = room::where('roomtype', $roomType)
            ->where('roomstatus', 'Available')
            ->inRandomOrder()
            ->first();

        if ($availableRoom) {
            return redirect()->to('/roomdetails/' . $availableRoom->roomID);
        }

        session()->flash('error', 'No available rooms found for ' . $roomType);
        return redirect()->back();
    }
}