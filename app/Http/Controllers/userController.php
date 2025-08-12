<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DeptAccount;

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

    return redirect('/login');
}
}
