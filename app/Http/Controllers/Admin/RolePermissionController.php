<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\User;
use App\Repositories\RolePermission\RolePermissionRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function __construct(
        private RolePermissionRepositoryInterface $rolePermissionrepository,
        private UserRepositoryInterface $userRepository
    ) {}

    public function index()
    {
        $roles = $this->rolePermissionrepository->getAllRole();
        $permissions = $this->rolePermissionrepository->getAllPermission();
        //dd($users);
        return view('admin.user.role.index', compact('roles', 'permissions'));
    }

    public function updatePermission(Request $request)
    {

        // dd($request->all());
        if ($this->rolePermissionrepository->updatePermission($request->except('_token'))) {
            return redirect()->back()->with('success', __('messages.success.update'));
        }
        return back();
    }

    public function storeRole(RoleRequest $request)
    {
        if ($this->rolePermissionrepository->storeRole($request->all())) {
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

    public function destroy($id)
    {
        if ($this->rolePermissionrepository->destroyRole($id)) {
            return back()->with('success', __('messages.success.delete'));
        }
        return back()->with('error', __('messages.error.delete'));
    }
}
