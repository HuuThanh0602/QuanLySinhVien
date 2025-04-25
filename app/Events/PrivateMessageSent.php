<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class PrivateMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        
        $roomId=$this->generateRoomId($this->message->from_id,$this->message->to_id);
        
        Log::info("Room ID ".$roomId);
        return new PrivateChannel('chat.room.'.$roomId);
    }

    protected function generateRoomId($id1,$id2){
        return 'room_' . min($id1,$id2).'_'.max($id1,$id2);
    }
    
    public function broadcastAs()
    { 
        Log::info("Room Nè");
        return 'PrivateMessageSent';
    }
}
