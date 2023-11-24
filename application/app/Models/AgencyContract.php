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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AgencyContract extends Model implements HasMedia
{
    use HasFactory,
    GenerateUuidModelTrait,
    InteractsWithMedia,
        ModelAddMediaTrait;

    public const MEDIA_NAME_AGENCY_CONTRACT   = 'agency_contract';
    public const MEDIA_PREFIX_AGENCY_CONTRACT = 'agency_contract/';

    protected $fillable = [
        'uuid',
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

    public function generateContract()
    {
        return PDF::loadView('agency_contract')
            ->setPaper('a4')
            ->download('Агентский договор на поиск клиентов.pdf');
    }
    public function getAgencyContractMedia(): ?Media
    {
        return $this->getMedia(self::MEDIA_PREFIX_AGENCY_CONTRACT . $this->uuid)->first();
    }
    public function addAgencyContractMedia(): void
    {
        $this->modelAddMedia(self::MEDIA_NAME_AGENCY_CONTRACT, self::MEDIA_PREFIX_AGENCY_CONTRACT . $this->uuid);
    }
    public function deleteAgencyContractMedia(): void
    {
        if ($agencyContractMedia = $this->getAgencyContractMedia()) {
            $agencyContractMedia->delete();
        }
    }
}
