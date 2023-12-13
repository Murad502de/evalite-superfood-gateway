<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use App\Traits\ImgTrait;
use App\Traits\ModelAddMediaTrait;
use App\Traits\PdfTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AgencyContract extends Model implements HasMedia
{
    use HasFactory,
    GenerateUuidModelTrait,
    InteractsWithMedia,
    ModelAddMediaTrait,
    ImgTrait,
        PdfTrait;

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

    // public function generateContract()
    // {
    //     return PDF::loadView('agency_contract')
    //         ->setPaper('a4')
    //         ->download('Агентский договор на поиск клиентов.pdf');
    // }

    public static function generateContract()
    {
        $pdf_data = [
            'number'                             => '8-23/9-D-ru',
            'date'                               => '11.10.2023',
            'signature_base64'                   => self::imageToBase64(base_path('resources/img/signature.jpg')),
            'partner_full_name'                  => 'Эвалайт Эвалайт Эвалайт',
            'partner_registration_address'       => '352690, Россия, Краснодарский край, Апшеронский р-н, г Апшеронск, ул. Фрунзе, д 90',
            'partner_inn'                        => '236802411681',
            'partner_ogrnip'                     => '316236800058347',
            'partner_checking_account'           => '40802810200003601872',
            'partner_bank'                       => 'АО "ТИНЬКОФФ БАНК"',
            'partner_bank_inn'                   => '7710140679',
            'partner_bank_bic'                   => '044525974',
            'partner_bank_correspondent_account' => '30101810145250000974',
            'partner_bank_legal_address'         => 'Москва, 127287, ул. Хуторская 2-я, д. 38А, стр. 26',
        ];

        return self::loadPdfFromView('agency_contract_v2', $pdf_data, "8-23/9-D-ru");
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
