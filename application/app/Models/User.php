<?php

namespace App\Models;

use App\Traits\GenerateUserTokenTrait;
use App\Traits\GenerateUuidModelTrait;
use App\Traits\ModelAddMediaTrait;
use App\Traits\PasswordEncryptTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Model implements HasMedia
{
    use HasFactory,
    InteractsWithMedia,
    GenerateUuidModelTrait,
    GenerateUserTokenTrait,
    PasswordEncryptTrait,
        ModelAddMediaTrait;

    public const MEDIA_NAME_AVATAR   = 'user_avatar';
    public const MEDIA_PREFIX_AVATAR = 'user_avatar/';

    protected $fillable = [
        'uuid',
        'role_id',
        'first_name',
        'second_name',
        'third_name',
        'gender',
        'birthday',
        'employment_type',
        'email',
        'password',
        'token',
        'phone',
        'invite_code',
        'individual_code',
        'promo_code',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'role_id',
        'password',
    ];

    public static function createNew(array $data)
    {
        $user = self::create([
            'role_id'         => $data['user_role_uuid'] ?? Role::whereIsDefault(true)->first()->id,
            'first_name'      => $data['user_first_name'],
            'second_name'     => $data['user_second_name'],
            'third_name'      => $data['user_third_name'],
            'gender'          => $data['user_gender'],
            'birthday'        => Carbon::parse($data['user_birthday']),
            'employment_type' => $data['user_employment_type'],
            'email'           => $data['user_email'],
            'password'        => self::passwordEncrypt($data['user_password']),
            'token'           => self::generateUserToken(),
            'phone'           => $data['user_phone'],
            'invite_code'     => Str::upper(Str::random(6)),
            'individual_code' => Str::upper(Str::random(6)),
            'promo_code'      => $data['user_promo_code'],
        ]);

        $user->modelAddMedia(self::MEDIA_NAME_AVATAR, self::MEDIA_PREFIX_AVATAR . $user->uuid);
        $user->passport()->create([
            'full_name'       => $data['pass_full_name'],
            'series'          => $data['pass_series'],
            'number'          => $data['pass_number'],
            'issue_date'      => Carbon::parse($data['pass_issue_date']),
            'validity'        => Carbon::parse($data['pass_validity']),
            'issue_by'        => $data['pass_issue_by'],
            'department_code' => $data['pass_department_code'],
        ]);
        $user->passport->addMainSpreadMedia();
        $user->passport->addRegistrationSpreadMedia();
        $user->passport->addVerificationSpreadMedia();
        $user->paymentDetailsIndividualEntrepreneur()->create([
            'full_name'                  => $data['ie_full_name'],
            'organization_legal_address' => $data['ie_organization_legal_address'],
            'inn'                        => $data['ie_inn'],
            'ogrn'                       => $data['ie_ogrn'],
            'transaction_account'        => $data['ie_transaction_account'],
            'bank'                       => $data['ie_bank'],
            'bank_inn'                   => $data['ie_bank_inn'],
            'bank_bic'                   => $data['ie_bank_bic'],
            'bank_correspondent_account' => $data['ie_bank_correspondent_account'],
            'bank_legal_address'         => $data['ie_bank_legal_address'],
        ]);
        $user->paymentDetailsIndividualEntrepreneur->modelAddMedia(
            PaymentDetailsIndividualEntrepreneur::MEDIA_NAME,
            PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $user->paymentDetailsIndividualEntrepreneur->uuid
        );

        return $user;
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function passport(): HasOne
    {
        return $this->hasOne(Passport::class);
    }
    public function paymentDetailsIndividualEntrepreneur(): HasOne
    {
        return $this->hasOne(PaymentDetailsIndividualEntrepreneur::class);
    }
}
