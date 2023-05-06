<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amocrm extends Model
{
    use HasFactory, GenerateUuidModelTrait;

    protected $fillable = [
        'uuid',
        'client_id',
        'client_secret',
        'subdomain',
        'access_token',
        'redirect_uri',
        'token_type',
        'refresh_token',
        'when_expires',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
