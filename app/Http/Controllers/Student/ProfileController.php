<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function index()
    {
        $infor = $this->userRepository->getInfor();
        return view('student.profile', compact('infor'));
    }

    public function update(Request $request, string $id)
    {
        $file = $request->file('image');
        if ($this->userRepository->upLoadAvatar($file, $id)) {
            return redirect()->route('student.profile.index')->with('success', 'ok');
        };
        return back()->with('success', __('messages.success.update'));
    }
}
