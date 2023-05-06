<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuidModelTrait;

class Sale extends Model
{
    use HasFactory, GenerateUuidModelTrait;

    protected $fillable = [
        'uuid',
        'percent',
        'status',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
