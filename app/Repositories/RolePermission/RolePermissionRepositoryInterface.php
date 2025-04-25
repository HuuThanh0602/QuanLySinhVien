<?php

namespace App\Repositories\RolePermission;

use App\Repositories\RepositoryInterface;

interface RolePermissionRepositoryInterface
{
    public function getAllRole();
    public function getAllPermission();
    public function getRoleById($id);
    public function updatePermission($rolePermission);
    public function storeRole($attribute);
    public function destroyRole($id);
}
