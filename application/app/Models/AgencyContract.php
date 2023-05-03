<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use App\Traits\ModelAddMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PDF;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AgencyContract extends Model implements HasMedia
{
    use HasFactory,
    GenerateUuidModelTrait,
    InteractsWithMedia,
        ModelAddMediaTrait;

    public const MEDIA_NAME_AGENCY_CONTRACT   = 'agency_contracts';
    public const MEDIA_PREFIX_AGENCY_CONTRACT = 'agency_contracts/';

    protected $fillable = [
        'uuid',
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

    public function generateContract()
    {
        return PDF::loadView('agency_contract')
            ->setPaper('a4')
            ->download('Агентский договор на поиск клиентов.pdf');
    }
}
