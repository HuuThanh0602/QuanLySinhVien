<?php

namespace App\Repositories\Message;

use App\Events\MessageSent;
use App\Events\PrivateMessageSent;
use App\Repositories\BaseRepository;
use App\Repositories\Message\MessageRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Message::class;
    }
    public function getMessages($id)
    {
        $authId = Auth::id();

        $messages = $this->model
            ->with(['fromStudent'])
            ->where(function ($query) use ($authId, $id) {
                $query->where('from_id', $authId)
                    ->where('to_id', $id);
            })
            ->orWhere(function ($query) use ($authId, $id) {
                $query->where('from_id', $id)
                    ->where('to_id', $authId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return  $messages;
    }
    public function sendMessage($request){
        $message = $this->model->create([
            'from_id' => Auth::id(),
            'to_id' => $request->to_id,
            'content' => $request->content,
        ]);

        $message->load('fromStudent');
        
        broadcast(new PrivateMessageSent($message));

        return $message;
    }
}
