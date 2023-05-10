<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GenerateUuidModelTrait;

class ConfigurationPercentageLevel extends Model
{
    use HasFactory, GenerateUuidModelTrait;

    protected $fillable = [
        'uuid',
        'percentage',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
