<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use App\Traits\ModelAddMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PaymentDetailsIndividualEntrepreneur extends Model implements HasMedia
{
    use HasFactory,
    InteractsWithMedia,
    GenerateUuidModelTrait,
        ModelAddMediaTrait;

    public const MEDIA_NAME   = 'ie_confirm_doc';
    public const MEDIA_PREFIX = 'ie_confirm_doc/';

    protected $fillable = [
        'uuid',
        'full_name',
        'organization_legal_address',
        'inn',
        'ogrn',
        'transaction_account',
        'bank',
        'bank_inn',
        'bank_bic',
        'bank_correspondent_account',
        'bank_legal_address',
    ];
    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /* RELATIONS */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
