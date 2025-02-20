<?php
namespace App\Models\Traits;

use App\Models\User;

trait HasUser 
{
    public function user()
    {
        return $this->hasOne(User::class , 'user_id');
    }
}