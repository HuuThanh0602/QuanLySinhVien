<?php

namespace App\Models\Traits;

use App\Models\Message;

trait HasMessages
{


    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'from_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'to_id');
    }
}
