<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Passport extends Model implements HasMedia
{
    use HasFactory,
    GenerateUuidModelTrait,
        InteractsWithMedia;

    public const MEDIA_PREFIX_MAIN_SPREAD         = 'passport_main_spread/';
    public const MEDIA_PREFIX_REGISTRATION_SPREAD = 'passport_registration_spread/';
    public const MEDIA_PREFIX_VERIFICATION_SPREAD = 'passport_verification_spread/';

    protected $fillable = [
        'uuid',
        'full_name',
        'series',
        'number',
        'issue_date',
        'validity',
        'issue_by',
        'department_code',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addMainSpreadMedia(): void
    {
        $this->addSpreadMedia('passport_main_spread', self::MEDIA_PREFIX_MAIN_SPREAD . $this->uuid);
    }
    public function addRegistrationSpreadMedia(): void
    {
        $this->addSpreadMedia('passport_registration_spread', self::MEDIA_PREFIX_REGISTRATION_SPREAD . $this->uuid);
    }
    public function addVerificationSpreadMedia(): void
    {
        $this->addSpreadMedia('passport_verification_spread', self::MEDIA_PREFIX_VERIFICATION_SPREAD . $this->uuid);
    }

    private function addSpreadMedia(string $mediaFromRequest, string $mediaCollection): void
    {
        $this->addMediaFromRequest($mediaFromRequest)
            ->sanitizingFileName(function ($fileName) {
                return strtolower($fileName);
            })
            ->toMediaCollection($mediaCollection);
    }
}
