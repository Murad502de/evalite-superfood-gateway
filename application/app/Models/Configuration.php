<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuidModelTrait;

class Configuration extends Model
{
    use HasFactory, GenerateUuidModelTrait;

    protected $fillable = [
        'uuid',
        'amocrm_subdomain',
        'amocrm_redirect_uri',
        'amocrm_client_secret',
        'min_payout',
        'personal_link_host',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
