<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /* RELATIONS */
    public function payout(): BelongsTo
    {
        return $this->belongsTo(Payout::class);
    }
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
