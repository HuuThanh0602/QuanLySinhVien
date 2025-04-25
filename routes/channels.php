<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('notifications', function ($user) {
    return true;
});

Broadcast::channel('chat', function ($user) {
    if ($user != null && $user->student != null) {
        return [
            'id' => $user->student->id,
            'name' => $user->student->full_name
        ];
    }
    return false;
});

Broadcast::channel('chat.room.{roomId}', function ($user, $roomId) {
    return true; 
});

