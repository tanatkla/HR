<?php
 
namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\User;

use Notification;
use App\Notifications\InvoicePaidNotification;
use Illuminate\Notifications\Notification as NotificationsNotification;

class NotificationController extends Controller
{ 
    public function index()
    {
        $invoices = User::where('user_id', auth()->user()->id)->get();
 
        return view('invoices', compact('invoices'));
    }
 
    public function show(User $invoice)
    {
        return view('invoices', compact('invoice'));
    }
     
    public function sendInvoicePaidNotification(Request $request) 
    {   
        $request->validate([
            'invoice_id'=>'required|exists:invoices,id',
        ]);
 
        $user = auth()->user();
 
        $invoice = User::find($request->invoice_id)->first();
 
        $invoice['buttonText'] = 'View Invoice';
        $invoice['invoiceUrl'] = route('show.invoice');
        $invoice['thanks'] = 'Your thank you message';
   
        Notifications::send($user, new InvoicePaidNotification($invoice));
    
        return back()->with('You have successfully paid the invoice');
    }
}