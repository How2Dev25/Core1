<?php

namespace App\Http\Controllers;

use App\Models\additionalRoom;
use App\Models\room_maintenance;
use Illuminate\Http\Request;
use App\Models\room;
use Termwind\Components\Raw;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AuditTrails;
use App\Models\roomtypes;
use App\Models\dynamicBilling;

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
                'roomphoto' => 'images/defaults/hotel.png'
            ];

            room::create($roomData);

               AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Room Management And Service',
            'action' => 'Create Room',
            'activity' => 'Creating Of Room',
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);

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
        ]);

        $form['roomstatus'] = 'Available';
        $form['roomfeatures'] = implode(',', $form['roomfeatures']);
        

        $filename = time(). '_' . $request->file('roomphoto')->getClientOriginalName();
        $filepath = 'images/rooms/' .$filename;
        $request->file('roomphoto')->move(public_path('images/rooms/'), $filename);
        $form['roomphoto'] = $filepath;

        

         $createRoom =  room::create($form);


if ($form['roomstatus'] === 'Maintenance') {
    Room_Maintenance::create([
        'maintenancestatus' => 'Pending',
        'maintenancedescription' => 'This Room Needs Maintenance',
        'maintenanceassigned_To' => 'Juan Dela Cruz',
         'maintenance_priority' => 'Medium',
        'roomID' => $createRoom->roomID,
    ]);
}

    AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Room Management And Service',
            'action' => 'Create Room',
            'activity' => 'Creating Of Room',
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);


        session()->flash('roomcreated', 'Room Has Been Added');

        return redirect()->back();
    }

    public function delete(Request $request, room $roomID){
        $roomID->delete();

            AuditTrails::create([
            'dept_id' => Auth::user()->Dept_id,
            'dept_name' => Auth::user()->dept_name,
            'modules_cover' => 'Room Management And Service',
            'action' => 'Removal Of Room',
            'activity' => 'Removed Room #' . $roomID->roomID,
            'employee_name' => Auth::user()->employee_name,
            'employee_id' => Auth::user()->employee_id,
            'role' => Auth::user()->role,
            'date' => Carbon::now()->toDateTimeString(),
        ]);


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

              if ($form['roomstatus'] === 'Maintenance') {
    // Check if maintenance record already exists
    $existingMaintenance = room_maintenance::where('roomID', $roomID->roomID)
                                        ->where('maintenancestatus', '!=', 'Completed')
                                        ->first();
    
                if (!$existingMaintenance) {
                    // Only create new record if one doesn't already exist
                room_maintenance::create([
                        'maintenancestatus' => 'Pending',
                        'maintenancedescription' => 'This Room Needs Maintenance',
                        'maintenanceassigned_To' => 'Juan Dela Cruz',
                        'maintenance_priority' => 'Medium',
                        'roomID' => $roomID->roomID,
                    ]);
                }
            } else {
                // Only update active maintenance records (not already completed)
                room_maintenance::where('roomID', $roomID->roomID)
                            ->where('maintenancestatus', '!=', 'Completed')
                            ->update([
                                'maintenancestatus' => 'Completed',
                                'updated_at' => now() // Consider adding this field
                            ]);
            }


                        AuditTrails::create([
                        'dept_id' => Auth::user()->Dept_id,
                        'dept_name' => Auth::user()->dept_name,
                        'modules_cover' => 'Room Management And Service',
                        'action' => 'Modify Of Room',
                        'activity' => 'Modify Room #' . $roomID->roomID,
                        'employee_name' => Auth::user()->employee_name,
                        'employee_id' => Auth::user()->employee_id,
                        'role' => Auth::user()->role,
                        'date' => Carbon::now()->toDateTimeString(),
                    ]);

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

                     AuditTrails::create([
                        'dept_id' => Auth::user()->Dept_id,
                        'dept_name' => Auth::user()->dept_name,
                        'modules_cover' => 'Room Management And Service',
                        'action' => 'Added Photo',
                        'activity' => 'Added Additional Photo For  #' .$form['roomID'],
                        'employee_name' => Auth::user()->employee_name,
                        'employee_id' => Auth::user()->employee_id,
                        'role' => Auth::user()->role,
                        'date' => Carbon::now()->toDateTimeString(),
                    ]);

        session()->flash('photoadded', 'Additional Photo for this Room Has Been Added');

        return redirect()->back();
    }

    public function deleteroomphoto(additionalRoom $roomphotoID){
        $roomphotoID->delete();

         AuditTrails::create([
                        'dept_id' => Auth::user()->Dept_id,
                        'dept_name' => Auth::user()->dept_name,
                        'modules_cover' => 'Room Management And Service',
                        'action' => 'Remove Additional Photo',
                        'activity' => 'Removed Additional Photo For  #' .$roomphotoID->roomID,
                        'employee_name' => Auth::user()->employee_name,
                        'employee_id' => Auth::user()->employee_id,
                        'role' => Auth::user()->role,
                        'date' => Carbon::now()->toDateTimeString(),
                    ]);

         session()->flash('photoremoved', 'Photo Has Been Removed');

        return redirect()->back();
    }


    public function roomdetails($roomID){
        $room = room::where('roomID', $roomID)->first();
        $roomphotos = additionalRoom::
        join('core1_room', 'core1_room.roomID', '=', 'core1_roomphotos.roomID')
        ->where('core1_roomphotos.roomID', $roomID)
        ->latest('core1_roomphotos.created_at')
        ->get();

        return view('guest.components.dashboard.rooms.roomdetails', ['room' => $room, 'roomphotos' => $roomphotos]);
    }

    public function reservethisroom($roomID){
          $room = room::where('roomID', $roomID)->first();
           $servicefee = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
            $taxrate = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');
            $additionalpersonfee = dynamicBilling::where('dynamic_name', 'Additional Person Fee')->value('dynamic_price');

          return view('guest.components.dashboard.rooms.reserveroom', ['room' => $room, 'servicefee' => $servicefee
        , 'taxrate' => $taxrate, 'additionalpersonfee' => $additionalpersonfee]);
    }


    public function storeroomtype(Request $request){
        $form = $request->validate([
            'roomtype_name' => 'required',
            'roomtype_description' => 'required',
        ]);

        roomtypes::create($form);

        return redirect()->back()->with('success', 'Room Type Has Been Added');
    }

    public function modifyroomtype(Request $request, roomtypes $roomtypesID){
        $form = $request->validate([
            'roomtype_name' => 'required',
            'roomtype_description' => 'required',
        ]);

        $roomtypesID->update($form);

       return redirect()->back()->with('success', 'Room Type Has Been Modified');
    }

    public function deleteroomtype(roomtypes $roomtypesID){
        $roomtypesID->delete();

        return redirect()->back()->with('success', 'Room Type Has Been Removed');
    }


    
}
