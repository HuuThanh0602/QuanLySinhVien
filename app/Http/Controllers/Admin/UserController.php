<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\RolePermission\RolePermissionRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(
        private RolePermissionRepositoryInterface $rolePermissionrepository,
        private UserRepositoryInterface $userRepository
    ) {}

    public function index()
    {
        $roles = $this->rolePermissionrepository->getAllRole();
        $users = $this->userRepository->getUserAdmin();
        // dd($users);
        return view('admin.user.user.index', compact('users', 'roles'));
    }
    public function store(UserRequest $request)
    {
        if ($this->userRepository->store($request)) {
            session()->flash('success', __('messages.success.create'));
            return response()->json([
                'success' => true,
            ]);
        }
        session()->flash('error', __('messages.error.create'));
        return response()->json([
            'success' => false,
        ]);
    }


    public function update(Request $request)
    {
        if ($this->userRepository->updateRole($request)) {
            return redirect()->route('admin.user.index')->with('success', __('messages.success.update'));
        };
    }
}
