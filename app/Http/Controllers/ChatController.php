<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $chatRooms = ChatRoom::all();
        return response()->json($chatRooms);
    }

    public function show(ChatRoom $chatRoom)
    {
        $messages = $chatRoom->messages()->with('user')->get();
        return response()->json($messages);
    }

    public function store(Request $request, ChatRoom $chatRoom)
    {
        $message = new Message();
        $message->user_id = Auth::id();
        $message->chat_room_id = $chatRoom->id;
        $message->message = $request->input('message');
        $message->save();

        // Broadcast the message
        broadcast(new \App\Events\MessageSent($message))->toOthers();

        return response()->json($message);
    }
}
