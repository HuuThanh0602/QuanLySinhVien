<?php

namespace App\Models;

use App\Models\Traits\HasMessages;
use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'from_id',
        'to_id',
        'content'
    ];
    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
    public function fromStudent()
{
    return $this->hasOneThrough(
        Student::class,
        User::class,
        'id',           
        'user_id',      
        'from_id',     
        'id'            
    );
}
}
