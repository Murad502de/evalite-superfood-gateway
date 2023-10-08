<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use App\Traits\ModelAddMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PaymentDetailsSelfEmployed extends Model implements HasMedia
{
    use HasFactory,
    InteractsWithMedia,
    GenerateUuidModelTrait,
        ModelAddMediaTrait;

    public const MEDIA_NAME   = 'se_confirm_doc';
    public const MEDIA_PREFIX = 'se_confirm_doc/';

    protected $fillable = [
        'uuid',
        'full_name',
        'transaction_account',
        'inn',
        'swift',
        'mailing_address',
        'bank',
        'bic',
        'correspondent_account',
        'bank_inn',
        'bank_kpp',
    ];
    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
