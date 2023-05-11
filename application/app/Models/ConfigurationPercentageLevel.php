<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'configuration_id',
    ];

    /* RELATIONS */
    public function configuration(): BelongsTo
    {
        return $this->belongsTo(Configuration::class);
    }
}
