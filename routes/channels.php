<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chatRoomId}', function ($user, $chatRoomId) {
    // Add your authentication logic here, for example, you could check if the user is a member of the chat room.
    // return $user->canJoinChatRoom($chatRoomId);
    return true; // Allow all authenticated users to join the channel
});
