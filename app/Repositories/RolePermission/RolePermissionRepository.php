<?php

namespace App\Repositories\RolePermission;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionRepository  implements RolePermissionRepositoryInterface
{

    public function getAllRole()
    {
        return Role::with('Permissions')->get();
    }

    public function getAllPermission()
    {
        return Permission::all();
    }

    public function getRoleById($id)
    {
        return Role::with('Permissions')->where('id', '=', $id)->first();
    }

    public function updatePermission($rolePermission)
    {
        try {
            return DB::transaction(function () use ($rolePermission) {
                $rolePermission = $rolePermission['permission'] ?? [];

                $allRoles = Role::all();

                foreach ($allRoles as $role) {
                    if (isset($rolePermission[$role->id])) {
                        $permissionIds = $rolePermission[$role->id];
                        $permissions = Permission::whereIn('id', $permissionIds)->get();
                        $role->syncPermissions($permissions);
                    } else {
                        $role->syncPermissions([]);
                    }
                }
                return true;
            });
        } catch (\Exception $e) {
            return false; // Nếu có lỗi, rollback
        }
    }

    public function storeRole($attribute)
    {
        return Role::create(['name' =>  $attribute['name']]);
    }

    public function destroyRole($id)
    {
        return Role::findOrfail($id)->delete();
    }
}
