<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Student::class;
    }
    public function getAll()
    {
        return User::with('student')->get();
    }
    public function getInfor()
    {
        $userId = Auth::user()->id;
        return $this->getModel()::with('department', 'user')->where('user_id', $userId)->first();
    }

    public function upLoadAvatar($file, $id)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('avatars', $fileName);
        return $this->getModel()::where('id', $id)->update(['avatar' => $filePath]);;
    }

    public function getUserAdmin()
    {
        return User::with('roles')->where('role', 'admin')->get();
    }

    public function updateRole($request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->roles as $userId => $roleId) {
                $user = User::find($userId);
                if ($user) {
                    $user->roles()->detach();
                    $user->assignRole(Role::find($roleId));
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function store($request)
    {
        $request->merge(['role' => 'admin']);
        $data = $request->only('email', 'password', 'role');
        return User::create($data);
    }
}
