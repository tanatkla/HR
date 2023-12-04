<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ChatMessageController extends Controller
{
    public function index()
    {
        // return ChatMessage::all();
        
        $messages =  ChatMessage::all();
        return view('chat',[
            // 'data' => ChatMessage::all()
            'data' => ChatMessage::where('channel','39A-147-S4F-2')->get()
        ]);
        // return response()->json($messages);
    }

    public function message()
    {
        $data =  ChatMessage::all();
        $messages =  ChatMessage::where('channel','39A-147-S4F-2')->get();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        // $chatMessage = ChatMessage::create([
        //     'username' => $request->username,
        //     'message' => $request->message
        // ]);

        $chatMessage = new ChatMessage();
        $chatMessage->username = $request->username;
        $chatMessage->message = $request->message;
        $chatMessage->user_id = Auth::user()->id;
        $chatMessage->channel = "39A-147-S4F-2";
        $chatMessage->save();
        // dd($chatMessage);
       
        // $chatMessage =  ChatMessage::all();

        return $chatMessage;
    }
}
