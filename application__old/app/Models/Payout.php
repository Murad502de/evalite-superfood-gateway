<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use App\Traits\ModelAddMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Payout extends Model implements HasMedia
{
    use HasFactory,
    GenerateUuidModelTrait,
    InteractsWithMedia,
        ModelAddMediaTrait;

    public const MEDIA_NAME_RECEIPT       = 'payout_receipt';
    public const MEDIA_PREFIX_RECEIPT     = 'payout_receipt/';
    public const PAYOUT_RECEIPT_VIEW_NAME = 'payout_receipt';

    protected $fillable = [
        'uuid',
        'user_id',
        'price',
        'status',
    ];
    protected $hidden = [
        'id',
        'user_id',
        // 'created_at',
        'updated_at',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
