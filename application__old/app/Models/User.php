<?php

namespace App\Models;

use App\Events\UserRegisteredEvent;
use App\Libs\PetrovichPhpMaster\Petrovich;
use App\Models\Configuration;
use App\Traits\GenerateUserTokenTrait;
use App\Traits\GenerateUuidModelTrait;
use App\Traits\ModelAddMediaTrait;
use App\Traits\PasswordEncryptTrait;
use App\Traits\PdfTrait;
use App\Traits\SharedEmploymentTypesTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    ModelAddMediaTrait,
    SharedEmploymentTypesTrait,
        PdfTrait;

    public const MEDIA_NAME_AVATAR         = 'user_avatar';
    public const MEDIA_PREFIX_AVATAR       = 'user_avatar/';
    public const AGENCY_CONTRACT_VIEW_NAME = 'agency_contract';
    public const AGENCY_CONTRACT_FILE_NAME = 'Агентский договор на поиск клиентов.pdf';

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
        'verification_status',
    ];
    protected $hidden = [
        'id',
        // 'created_at',
        'updated_at',
        'role_id',
        'password',
        'token',
    ];

    public static function createNew(Request $request)
    {
        $data = $request->all();
        $user = self::create([
            'role_id'             => $data['user_role_uuid'] ?? Role::whereIsDefault(true)->first()->id,
            'first_name'          => $data['user_first_name'],
            'second_name'         => $data['user_second_name'],
            'third_name'          => $data['user_third_name'],
            'gender'              => $data['user_gender'],
            'birthday'            => Carbon::parse($data['user_birthday']),
            'employment_type'     => $data['user_employment_type'],
            'email'               => $data['user_email'],
            'password'            => self::passwordEncrypt($data['user_password']),
            'token'               => self::generateUserToken(),
            'phone'               => $data['user_phone'],
            'invite_code'         => Str::upper(Str::random(6)),
            'individual_code'     => Str::upper(Str::random(6)),
            'promo_code'          => $data['user_promo_code'],
            'verification_status' => config('constants.user.verification_statuses.waiting'),
        ]);

        if ($request->file(self::MEDIA_NAME_AVATAR)) {
            $user->modelAddMedia(self::MEDIA_NAME_AVATAR, self::MEDIA_PREFIX_AVATAR . $user->uuid);
        }

        $user->passport()->create([
            'full_name'            => $data['pass_full_name'],
            'series'               => $data['pass_series'],
            'number'               => $data['pass_number'],
            'issue_date'           => Carbon::parse($data['pass_issue_date']),
            'registration_address' => $data['pass_registration_address'],
            'issue_by'             => $data['pass_issue_by'],
            'department_code'      => $data['pass_department_code'],
        ]);
        $user->passport->addMainSpreadMedia();
        $user->passport->addRegistrationSpreadMedia();
        $user->passport->addVerificationSpreadMedia();

        if ($user->employment_type === self::$INDIVIDUAL_ENTREPRENEUR) {
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
        } else if ($user->employment_type === self::$SELF_EMPLOYED) {
            $user->paymentDetailsSelfEmployed()->create([
                'full_name'             => $data['se_full_name'],
                'transaction_account'   => $data['se_transaction_account'],
                'inn'                   => $data['se_inn'],
                'swift'                 => $data['se_swift'],
                'mailing_address'       => $data['se_mailing_address'],
                'bank'                  => $data['se_bank'],
                'bic'                   => $data['se_bic'],
                'correspondent_account' => $data['se_correspondent_account'],
                'bank_inn'              => $data['se_bank_inn'],
                'bank_kpp'              => $data['se_bank_kpp'],
            ]);
            $user->paymentDetailsSelfEmployed->modelAddMedia(
                PaymentDetailsSelfEmployed::MEDIA_NAME,
                PaymentDetailsSelfEmployed::MEDIA_PREFIX . $user->paymentDetailsSelfEmployed->uuid
            );
        }

        event(new UserRegisteredEvent($user));
        return $user;
    }

    public function updateUser(Request $request)
    {
        $data = $request->all();
        $this->update([
            'first_name'      => $data['user_first_name'] ?? $this->first_name,
            'second_name'     => $data['user_second_name'] ?? $this->second_name,
            'third_name'      => $data['user_third_name'] ?? $this->third_name,
            'gender'          => $data['user_gender'] ?? $this->gender,
            'birthday'        => $data['user_birthday'] ? Carbon::parse($data['user_birthday']) : $this->birthday,
            'employment_type' => $data['user_employment_type'] ?? $this->employment_type,
            'email'           => $data['user_email'] ?? $this->email,
            'phone'           => $data['user_phone'] ?? $this->phone,
        ]);

        if (isset($data['user_avatar'])) {
            $avatar = $this->getMedia(self::MEDIA_PREFIX_AVATAR . $this->uuid)->first();

            if ($avatar) {
                $avatar->delete();
            }

            if ($request->file(self::MEDIA_NAME_AVATAR)) {
                $this->modelAddMedia(self::MEDIA_NAME_AVATAR, self::MEDIA_PREFIX_AVATAR . $this->uuid);
            }
        }

        if ($this->passport) {
            $this->passport->update([
                'full_name'            => $data['pass_full_name'] ?? $this->passport->full_name,
                'series'               => $data['pass_series'] ?? $this->passport->series,
                'number'               => $data['pass_number'] ?? $this->passport->number,
                'issue_date'           => $data['pass_issue_date'] ? Carbon::parse($data['pass_issue_date']) : $this->passport->issue_date,
                'registration_address' => $data['pass_registration_address'] ?? $this->passport->registration_address,
                'issue_by'             => $data['pass_issue_by'] ?? $this->passport->issue_by,
                'department_code'      => $data['pass_department_code'] ?? $this->passport->department_code,
            ]);

            if (isset($data['passport_main_spread'])) {
                $passportMainSpread = $this->passport->getMedia(Passport::MEDIA_PREFIX_MAIN_SPREAD . $this->passport->uuid)->first();

                if ($passportMainSpread) {
                    $passportMainSpread->delete();
                }

                $this->passport->addMainSpreadMedia();
            }

            if (isset($data['passport_registration_spread'])) {
                $passportRegistrationSpread = $this->passport->getMedia(Passport::MEDIA_PREFIX_REGISTRATION_SPREAD . $this->passport->uuid)->first();

                if ($passportRegistrationSpread) {
                    $passportRegistrationSpread->delete();
                }

                $this->passport->addRegistrationSpreadMedia();
            }

            if (isset($data['passport_verification_spread'])) {
                $passportVerificationSpread = $this->passport->getMedia(Passport::MEDIA_PREFIX_VERIFICATION_SPREAD . $this->passport->uuid)->first();

                if ($passportVerificationSpread) {
                    $passportVerificationSpread->delete();
                }

                $this->passport->addVerificationSpreadMedia();
            }
        }

        if ($this->paymentDetailsIndividualEntrepreneur) {
            $this->paymentDetailsIndividualEntrepreneur->update([
                'full_name'                  => $data['ie_full_name'] ?? $this->full_name,
                'organization_legal_address' => $data['ie_organization_legal_address'] ?? $this->organization_legal_address,
                'inn'                        => $data['ie_inn'] ?? $this->inn,
                'ogrn'                       => $data['ie_ogrn'] ?? $this->ogrn,
                'transaction_account'        => $data['ie_transaction_account'] ?? $this->transaction_account,
                'bank'                       => $data['ie_bank'] ?? $this->bank,
                'bank_inn'                   => $data['ie_bank_inn'] ?? $this->bank_inn,
                'bank_bic'                   => $data['ie_bank_bic'] ?? $this->bank_bic,
                'bank_correspondent_account' => $data['ie_bank_correspondent_account'] ?? $this->bank_correspondent_account,
                'bank_legal_address'         => $data['ie_bank_legal_address'] ?? $this->bank_legal_address,
            ]);

            if (isset($data['ie_confirm_doc'])) {
                $confirmDocIE = $this->paymentDetailsIndividualEntrepreneur->getMedia(PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $this->paymentDetailsIndividualEntrepreneur->uuid)->first();

                if ($confirmDocIE) {
                    $confirmDocIE->delete();
                }

                $this->paymentDetailsIndividualEntrepreneur->modelAddMedia(
                    PaymentDetailsIndividualEntrepreneur::MEDIA_NAME,
                    PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $this->paymentDetailsIndividualEntrepreneur->uuid
                );
            }
        }

        if ($this->paymentDetailsSelfEmployed) {
            $this->paymentDetailsSelfEmployed->update([
                'full_name'             => $data['se_full_name'] ?? $this->full_name,
                'transaction_account'   => $data['se_transaction_account'] ?? $this->transaction_account,
                'inn'                   => $data['se_inn'] ?? $this->inn,
                'swift'                 => $data['se_swift'] ?? $this->swift,
                'mailing_address'       => $data['se_mailing_address'] ?? $this->mailing_address,
                'bank'                  => $data['se_bank'] ?? $this->bank,
                'bic'                   => $data['se_bic'] ?? $this->bic,
                'correspondent_account' => $data['se_correspondent_account'] ?? $this->correspondent_account,
                'bank_inn'              => $data['se_bank_inn'] ?? $this->bank_inn,
                'bank_kpp'              => $data['se_bank_kpp'] ?? $this->bank_kpp,
            ]);

            if (isset($data['se_confirm_doc'])) {
                $confirmDocSE = $this->paymentDetailsSelfEmployed->getMedia(PaymentDetailsSelfEmployed::MEDIA_PREFIX . $this->paymentDetailsSelfEmployed->uuid)->first();

                if ($confirmDocSE) {
                    $confirmDocSE->delete();
                }

                $this->paymentDetailsSelfEmployed->modelAddMedia(
                    PaymentDetailsSelfEmployed::MEDIA_NAME,
                    PaymentDetailsSelfEmployed::MEDIA_PREFIX . $this->paymentDetailsSelfEmployed->uuid
                );
            }
        }

        //FIXME must refactored
        if (isset($data[AgencyContract::MEDIA_NAME_AGENCY_CONTRACT])) {
            Log::info(__METHOD__, ['MEDIA_NAME_AGENCY_CONTRACT']); //DELETE
            Log::info(__METHOD__, [$data[AgencyContract::MEDIA_NAME_AGENCY_CONTRACT]]); //DELETE

            if ($request->file(AgencyContract::MEDIA_NAME_AGENCY_CONTRACT) === null) {
                Log::info(__METHOD__, ['Delete AGENCY_CONTRACT']); //DELETE

                if ($this->agencyContract) {
                    $this->agencyContract->delete();
                }
            } else {
                Log::info(__METHOD__, ['Update or Create AGENCY_CONTRACT']); //DELETE

                if ($this->agencyContract) {
                    Log::info(__METHOD__, ['Update AGENCY_CONTRACT']); //DELETE

                    $agencyContractMedia = $this->agencyContract->getMedia(AgencyContract::MEDIA_PREFIX_AGENCY_CONTRACT . $this->agencyContract->uuid)->first();

                    // dump($agencyContractMedia); //DELETE

                    if ($agencyContractMedia) {
                        $agencyContractMedia->delete();
                    }

                    if ($request->file(AgencyContract::MEDIA_NAME_AGENCY_CONTRACT)) {
                        $this->agencyContract->modelAddMedia(
                            AgencyContract::MEDIA_NAME_AGENCY_CONTRACT,
                            AgencyContract::MEDIA_PREFIX_AGENCY_CONTRACT . $this->agencyContract->uuid
                        );
                    }
                } else {
                    // dump('create'); //DELETE

                    Log::info(__METHOD__, ['Create AGENCY_CONTRACT']); //DELETE

                    $agencyContract = $this->agencyContract()->create();
                    $agencyContract->modelAddMedia(
                        AgencyContract::MEDIA_NAME_AGENCY_CONTRACT,
                        AgencyContract::MEDIA_PREFIX_AGENCY_CONTRACT . $agencyContract->uuid
                    );
                }
            }

        } else {
            // dump('delete'); //DELETE

            // if ($this->agencyContract) {
            //     $this->agencyContract->delete();
            // }
        }
    }
    public function addAgencyContract(Request $request)
    {
        if ($this->agencyContract) {
            $this->agencyContract->delete();
        }

        Log::info(__METHOD__, ['Create AGENCY_CONTRACT']); //DELETE

        $agencyContract = $this->agencyContract()->create();
        $agencyContract->modelAddMedia(
            AgencyContract::MEDIA_NAME_AGENCY_CONTRACT,
            AgencyContract::MEDIA_PREFIX_AGENCY_CONTRACT . $agencyContract->uuid
        );
    }

    public function getAgencyContractData(): array
    {
        $petrovich = new Petrovich(Petrovich::GENDER_MALE);

        return [
            'number'                        => AgencyContract::all()->count() + 1,
            'contract_creation_date'        => '"' . getdate()['mday'] . '"' . ' ' . config('constants.months.ru.ordinals')[5] . ' ' . getdate()['year'],
            'contract_expiration_date'      => '"' . getdate()['mday'] . '"' . ' ' . config('constants.months.ru.ordinals')[5] . ' ' . getdate()['year'] + 1,
            'remuneration_percentage'       => 30,
            'first_name_nominative'         => $petrovich->firstname($this->first_name, Petrovich::CASE_NOMENATIVE),
            'second_name_nominative'        => $petrovich->lastname($this->second_name, Petrovich::CASE_NOMENATIVE),
            'third_name_nominative'         => $petrovich->middlename($this->third_name, Petrovich::CASE_NOMENATIVE),
            'first_name_genitive'           => $petrovich->firstname($this->first_name, Petrovich::CASE_GENITIVE),
            'second_name_genitive'          => $petrovich->lastname($this->second_name, Petrovich::CASE_GENITIVE),
            'third_name_genitive'           => $petrovich->middlename($this->third_name, Petrovich::CASE_GENITIVE),
            'first_name_accusative'         => $petrovich->firstname($this->first_name, Petrovich::CASE_ACCUSATIVE),
            'second_name_accusative'        => $petrovich->lastname($this->second_name, Petrovich::CASE_ACCUSATIVE),
            'third_name_accusative'         => $petrovich->middlename($this->third_name, Petrovich::CASE_ACCUSATIVE),
            'first_name_dative'             => $petrovich->firstname($this->first_name, Petrovich::CASE_DATIVE),
            'second_name_dative'            => $petrovich->lastname($this->second_name, Petrovich::CASE_DATIVE),
            'third_name_dative'             => $petrovich->middlename($this->third_name, Petrovich::CASE_DATIVE),
            'first_name_instrumental'       => $petrovich->firstname($this->first_name, Petrovich::CASE_INSTRUMENTAL),
            'second_name_instrumental'      => $petrovich->lastname($this->second_name, Petrovich::CASE_INSTRUMENTAL),
            'third_name_instrumental'       => $petrovich->middlename($this->third_name, Petrovich::CASE_INSTRUMENTAL),
            'first_name_prepositional'      => $petrovich->firstname($this->first_name, Petrovich::CASE_PREPOSITIONAL),
            'second_name_prepositional'     => $petrovich->lastname($this->second_name, Petrovich::CASE_PREPOSITIONAL),
            'third_name_prepositional'      => $petrovich->middlename($this->third_name, Petrovich::CASE_PREPOSITIONAL),
            'full_name'                     => $this->passport->full_name,
            'short_name'                    => $this->second_name . ' ' . mb_substr($this->first_name, 0, 1) . '.' . ' ' . mb_substr($this->third_name, 0, 1) . '.',
            'gender'                        => $this->gender,
            'employment_type'               => $this->employment_type,
            'employment_type_nominative'    => $this->employment_type === 'individual_entrepreneur' ? 'Индивидуальный предприниматель' : ($this->gender === 'male' ? 'Самозанятый' : 'Самозанятая'),
            'employment_type_genitive'      => $this->employment_type === 'individual_entrepreneur' ? 'Индивидуальный предприниматель' : ($this->gender === 'male' ? 'Самозанятого' : 'Самозанятой'),
            'employment_type_accusative'    => $this->employment_type === 'individual_entrepreneur' ? 'Индивидуального предпринимателя' : ($this->gender === 'male' ? 'Самозанятого' : 'Самозанятую'),
            'employment_type_dative'        => $this->employment_type === 'individual_entrepreneur' ? 'Индивидуальный предприниматель' : ($this->gender === 'male' ? 'Самозанятому' : 'Самозанятой'),
            'employment_type_instrumental'  => $this->employment_type === 'individual_entrepreneur' ? 'Индивидуальный предприниматель' : ($this->gender === 'male' ? 'Самозанятым' : 'Самозанятой'),
            'employment_type_prepositional' => $this->employment_type === 'individual_entrepreneur' ? 'Индивидуальный предприниматель' : ($this->gender === 'male' ? 'Самозанятом' : 'Самозанятой'),
            'personal_link'                 => 'https://evalite.io/superfood?utm_source=' . $this->individual_code,
            'invite_code'                   => $this->invite_code,
            'email'                         => $this->email,
            'phone'                         => $this->phone,
            'pass_series'                   => $this->passport->series,
            'pass_number'                   => $this->passport->number,
            'pass_issue_by'                 => $this->passport->issue_by,
            'pass_department_code'          => $this->passport->department_code,
            'pass_registration_address'     => $this->passport->registration_address,
            'ie_full_name'                  => !!$this->paymentDetailsIndividualEntrepreneur ? $this->paymentDetailsIndividualEntrepreneur->full_name : null,
            'ie_organization_legal_address' => !!$this->paymentDetailsIndividualEntrepreneur ? $this->paymentDetailsIndividualEntrepreneur->organization_legal_address : null,
            'ie_inn'                        => !!$this->paymentDetailsIndividualEntrepreneur ? $this->paymentDetailsIndividualEntrepreneur->inn : null,
            'ie_ogrn'                       => !!$this->paymentDetailsIndividualEntrepreneur ? $this->paymentDetailsIndividualEntrepreneur->ogrn : null,
            'ie_transaction_account'        => !!$this->paymentDetailsIndividualEntrepreneur ? $this->paymentDetailsIndividualEntrepreneur->transaction_account : null,
            'ie_bank'                       => !!$this->paymentDetailsIndividualEntrepreneur ? $this->paymentDetailsIndividualEntrepreneur->bank : null,
            'ie_bank_inn'                   => !!$this->paymentDetailsIndividualEntrepreneur ? $this->paymentDetailsIndividualEntrepreneur->bank_inn : null,
            'ie_bank_bic'                   => !!$this->paymentDetailsIndividualEntrepreneur ? $this->paymentDetailsIndividualEntrepreneur->bank_bic : null,
            'ie_bank_correspondent_account' => !!$this->paymentDetailsIndividualEntrepreneur ? $this->paymentDetailsIndividualEntrepreneur->bank_correspondent_account : null,
            'ie_bank_legal_address'         => !!$this->paymentDetailsIndividualEntrepreneur ? $this->paymentDetailsIndividualEntrepreneur->bank_legal_address : null,
            'se_full_name'                  => !!$this->paymentDetailsSelfEmployed ? $this->paymentDetailsSelfEmployed->full_name : null,
            'se_transaction_account'        => !!$this->paymentDetailsSelfEmployed ? $this->paymentDetailsSelfEmployed->transaction_account : null,
            'se_inn'                        => !!$this->paymentDetailsSelfEmployed ? $this->paymentDetailsSelfEmployed->inn : null,
            'se_swift'                      => !!$this->paymentDetailsSelfEmployed ? $this->paymentDetailsSelfEmployed->swift : null,
            'se_mailing_address'            => !!$this->paymentDetailsSelfEmployed ? $this->paymentDetailsSelfEmployed->mailing_address : null,
            'se_bank'                       => !!$this->paymentDetailsSelfEmployed ? $this->paymentDetailsSelfEmployed->bank : null,
            'se_bic'                        => !!$this->paymentDetailsSelfEmployed ? $this->paymentDetailsSelfEmployed->bic : null,
            'se_correspondent_account'      => !!$this->paymentDetailsSelfEmployed ? $this->paymentDetailsSelfEmployed->correspondent_account : null,
            'se_bank_inn'                   => !!$this->paymentDetailsSelfEmployed ? $this->paymentDetailsSelfEmployed->bank_inn : null,
            'se_bank_kpp'                   => !!$this->paymentDetailsSelfEmployed ? $this->paymentDetailsSelfEmployed->bank_kpp : null,
        ];
    }
    public function generateAgencyContract()
    {
        return $this->loadPdfFromView(self::AGENCY_CONTRACT_VIEW_NAME, $this->getAgencyContractData());
    }
    public function getReferralLink()
    {
        $configuration = Configuration::first();
        return $configuration ? $configuration->personal_link_host . '?utm_source=' . $this->individual_code : null;
    }

    /* RELATIONS */
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
    public function paymentDetailsSelfEmployed(): HasOne
    {
        return $this->hasOne(PaymentDetailsSelfEmployed::class);
    }
    public function agencyContract(): HasOne
    {
        return $this->hasOne(AgencyContract::class);
    }
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }
}