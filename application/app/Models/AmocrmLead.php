<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmocrmLead extends Model
{
    use HasFactory, GenerateUuidModelTrait;

    protected $fillable = [
        'uuid',
        'amo_id',
        'last_modified',
        'data',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
