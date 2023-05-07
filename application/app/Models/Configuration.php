<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory, GenerateUuidModelTrait;

    protected $fillable = [
        'uuid',
        'amocrm_subdomain',
        'amocrm_redirect_uri',
        'amocrm_client_secret',
        'amocrm_utm_source_id',
        'min_payout',
        'personal_link_host',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
