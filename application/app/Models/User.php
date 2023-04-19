<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_role_id',
        'first_name',
        'second_name',
        'third_name',
        'gender',
        'birthday',
        'email',
        'password',
        'token',
        'phone',
        'invite_code',
        'individual_code',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'user_role_id',
        'password',
    ];
}
