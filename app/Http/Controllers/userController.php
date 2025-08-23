<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DeptAccount;
use App\Models\Guest;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
   public function login(Request $request)
{
    $form = $request->validate([
        'employee_id' => 'required',
        'password' => 'required',
    ]);

    // Always clear any existing session before logging in new user
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Find the user
    $user = DeptAccount::where('employee_id', $form['employee_id'])->first();

    // Compare plain-text password (⚠️ not recommended for production)
    if ($user && $user->password === $form['password']) {
        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/sampledash');
    }

    return back()->withErrors([
        'employee_id' => 'Invalid Employee ID or password.',
    ])->onlyInput('employee_id');
}

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/employeelogin');
}



// for guest
public function create(Request $request)
{
    $form = $request->validate([
        'guest_name'     => 'required|string|max:255',
        'guest_email'    => 'required|email|unique:core1_guest,guest_email',
        'guest_address'  => 'required|string|max:255',
        'guest_mobile'   => 'required|string|max:20',
        'guest_password' => 'required|string|confirmed',
        'guest_birthday' => 'required|date',
    ]);

    // Hash password before saving
    $form['guest_password'] = Hash::make($form['guest_password']);

    $guestAccount = Guest::create($form);

    // Auto login the new guest
    Auth::guard('guest')->login($guestAccount);

    // Store session data
    session(['guestSession' => $guestAccount]);

    return redirect('/photoupload');
}

public function profilesetup(Request $request, Guest $guestID){
    $form = $request->validate([
        'guest_photo' => 'required',
    ]);

    $filename = time() . '_' . $request->file('guest_photo')->getClientOriginalName();  
    $filepath = 'images/profiles/' .$filename;  
    $request->file('guest_photo')->move(public_path('images/profiles/'), $filename);
    $form['guest_photo'] = $filepath;

    $guestID->update($form);

     session()->flash('showwelcome');

    return redirect('/guestdashboard');
}

public function guestlogout(){
      Auth::guard('guest')->logout();

      return redirect('/loginguest');


}

public function guestlogin(Request $request){
    $form = $request->validate([
        'guest_email' => 'required',
        'guest_password' => 'required',
    ]);

    if(Auth::guard('guest')->attempt(['guest_email' => $form['guest_email'], 'password' => $form['guest_password']])){
       $request->session()->regenerate();

       session()->flash('showwelcome');

       return redirect('/guestdashboard');
    }
}

}
