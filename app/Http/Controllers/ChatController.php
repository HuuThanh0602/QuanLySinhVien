<?php

namespace App\Http\Controllers;

use App\Events\GreetingSent;
use App\Events\MessageSent;
use App\Events\PrivateMessageSent;
use App\Http\Controllers\Controller;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct(private MessageRepositoryInterface $messageRepository, private UserRepositoryInterface $userRepository) {}

    public function index()
    {
        $messages = $this->messageRepository->getAll();
        $users = $this->userRepository->getAll();


        return view('chat.chat', compact('messages', 'users'));
    }
    public function getMessages($id)
    {

        $message = $this->messageRepository->getMessages($id);
        return response()->json([
            'messages' => $message,
        ]);
    }

    public function sendMessage(Request $request)
    {
       $message = $this->messageRepository->sendMessage($request);
        return response()->json(['message' => $message]);
    }

    public function messageReceived(Request $request)
    {
        $rules = ['message' => 'required'];
        $request->validate($rules);

        $student = $request->user()->student;

        if (!$student) {
            return response()->json(['error' => 'Không tìm thấy student'], 400);
        }
        broadcast(new MessageSent($student, $request->message));
        return response()->json('Message broadcast');
    }


    public function indexAdmin()
    {
        return view('admin.chat');
    }

    public function indexStudent()
    {
        return view('student.chat');
    }

}
