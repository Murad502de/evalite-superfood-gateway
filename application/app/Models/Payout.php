<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payout extends Model
{
    use HasFactory, GenerateUuidModelTrait;

    protected $fillable = [
        'uuid',
        'status',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
