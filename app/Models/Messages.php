<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = [
        'name',
        'Email',
        'message',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

  
       
}
