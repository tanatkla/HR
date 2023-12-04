<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserRegisterController;
use App\Helpers\QR;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/dashboard', [App\Http\Controllers\AccountController::class, 'index'])->name('dashboard');
Route::resource('account', AccountController::class);
Route::get('position/get-data-edit', [PositionController::class, 'getDataEdit'])->name('position.get-data-edit');
Route::resource('position', PositionController::class);
Route::resource('leave-type', LeaveTypeController::class);
Route::post('leave/update-status', [LeaveController::class, 'updateStatus'])->name('leave.update-status');
Route::resource('leave', LeaveController::class);
Route::resource('calendar-manage', CalendarController::class);
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [ChartJSController::class, 'index'])->name('home');

// Route::get('/send-notification', [NotificationController::class, 'sendOfferNotification']);

#Store new user registered info into db and show notification to admin
 
Route::get('/user-register', [UserRegisterController::class,'register']);
Route::post('/user-register-store', [UserRegisterController::class,'postRegistration'])->name('user.registerd');
     
 
#Display all notifications to Admin
 
Route::get('/notification', [AdminController::class,'showNotificaton']);
 
#Notification mark as Read
 
Route::post('/mark-as-read',[AdminController::class, 'markNotification'])->name('markNotification');

Route::get('calender', [FullCalenderController::class, 'index'])->name('calender');
Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);

Route::get('test', function () {
    event(new App\Events\MessageSent('websolutionstuff_team'));
    return "Event has been sent!";
});


Route::get('/chat-messages', [ChatMessageController::class,'index']);
Route::get('/chat-messages-get', [ChatMessageController::class,'message']);
Route::post('/chat-messages-send', [ChatMessageController::class,'store']);



