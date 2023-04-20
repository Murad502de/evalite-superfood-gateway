<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentDetailsIndividualEntrepreneur extends Model
{
    use HasFactory;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
