<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => $request->user()->id,
            'chat_id' => $request->chat_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }

    public function fetchMessages($chatId)
    {
        $messages = Message::where('chat_id', $chatId)->get();

        return response()->json($messages);
    }
}

