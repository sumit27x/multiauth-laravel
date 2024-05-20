<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'username', 'password', 'gender', 'dob', 'registered_at', 'status'
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
}
