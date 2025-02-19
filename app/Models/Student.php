<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Student extends Model
{
    protected $fillable=[
        'full_name',
        'day_of_birth',
        'gender',
        'address',
        'phone',
        'user_id',
        'avatar',
        'department_id'
    ];
    public function user(){
        return $this->hasOne(User::class , 'user_id');
    }
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
}
