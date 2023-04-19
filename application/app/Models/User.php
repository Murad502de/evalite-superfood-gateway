<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const MEDIA_PREFIX = 'user/';

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

    public static function createNew(array $data)
    {
        dump($data); //DELETE
    }
}
