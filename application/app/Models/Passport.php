<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use App\Traits\ModelAddMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Passport extends Model implements HasMedia
{
    use HasFactory,
    GenerateUuidModelTrait,
    InteractsWithMedia,
        ModelAddMediaTrait;

    public const MEDIA_NAME_MAIN_SPREAD           = 'passport_main_spread';
    public const MEDIA_PREFIX_MAIN_SPREAD         = 'passport_main_spread/';
    public const MEDIA_NAME_REGISTRATION_SPREAD   = 'passport_registration_spread';
    public const MEDIA_PREFIX_REGISTRATION_SPREAD = 'passport_registration_spread/';
    public const MEDIA_NAME_VERIFICATION_SPREAD   = 'passport_verification_spread';
    public const MEDIA_PREFIX_VERIFICATION_SPREAD = 'passport_verification_spread/';

    protected $fillable = [
        'uuid',
        'full_name',
        'series',
        'number',
        'issue_date',
        'registration_address',
        'issue_by',
        'department_code',
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

    public function getMainSpreadMedia(): ?Media
    {
        return $this->getMedia(self::MEDIA_PREFIX_MAIN_SPREAD . $this->uuid)->first();
    }
    public function addMainSpreadMedia(): void
    {
        $this->modelAddMedia(self::MEDIA_NAME_MAIN_SPREAD, self::MEDIA_PREFIX_MAIN_SPREAD . $this->uuid);
    }
    public function deleteMainSpreadMedia(): void
    {
        if ($passportMainSpread = $this->getMainSpreadMedia()) {
            $passportMainSpread->delete();
        }
    }

    public function getRegistrationSpreadMedia(): ?Media
    {
        return $this->getMedia(self::MEDIA_PREFIX_REGISTRATION_SPREAD . $this->uuid)->first();
    }
    public function addRegistrationSpreadMedia(): void
    {
        $this->modelAddMedia(self::MEDIA_NAME_REGISTRATION_SPREAD, self::MEDIA_PREFIX_REGISTRATION_SPREAD . $this->uuid);
    }
    public function deleteRegistrationSpreadMedia(): void
    {
        if ($registrationSpreadMedia = $this->getRegistrationSpreadMedia()) {
            $registrationSpreadMedia->delete();
        }
    }

    public function getVerificationSpreadMedia(): ?Media
    {
        return $this->getMedia(Passport::MEDIA_PREFIX_VERIFICATION_SPREAD . $this->uuid)->first();
    }
    public function addVerificationSpreadMedia(): void
    {
        $this->modelAddMedia(self::MEDIA_NAME_VERIFICATION_SPREAD, self::MEDIA_PREFIX_VERIFICATION_SPREAD . $this->uuid);
    }
    public function deleteVerificationSpreadMedia(): void
    {
        if ($verificationSpreadMedia = $this->getVerificationSpreadMedia()) {
            $verificationSpreadMedia->delete();
        }
    }
}
