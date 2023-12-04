<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Session;
 
 
class AdminController extends Controller
{
 
  public function showNotificaton()
    {
      $notifications = User::first()->unreadNotifications;
      return view('showNotification', compact('notifications'));
    }
     
    public function markNotification(Request $request)
    {
        User::first()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();
  
        return response()->noContent();
    }
}