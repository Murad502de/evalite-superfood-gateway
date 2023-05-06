<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory, GenerateUuidModelTrait;

    protected $fillable = [
        'uuid',
        'percent',
        'status',
        'lead_id',
        'user_id',
        'payout_id',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
