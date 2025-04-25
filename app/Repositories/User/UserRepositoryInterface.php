<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getInfor();
    public function upLoadAvatar($file, $id);
    public function getUserAdmin();
    public function updateRole($request);
    public function store($request);
}
