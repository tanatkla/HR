<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewUserRegisterNotification;
 
class UserRegisterController extends Controller
{
    public function register()
    {
        return view('notificationExample.register');
    }
 
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:5',
           ]);
 
           $user = new User;
           $user->name         = $request->name;
           $user->email         = $request->email;
        //    $user->phone       = $request->phone;
           $user->password  = Hash::make($request->password);
           $user->save();
 
           $notification = User::first();
           #store notification info into notifications table
           $notification->notify(new NewUserRegisterNotification($user));
           dd('user registered successfully, Notification send to Admin Successfully.');
        }
    }