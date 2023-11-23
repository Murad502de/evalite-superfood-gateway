<?php

namespace App\Helpers\User;

use App\Models\Passport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserUpdateHelper
{
    public function update(User $user, array $data)
    {
        $user->update([
            'first_name'      => $data['user_first_name'] ?? $user->first_name,
            'second_name'     => $data['user_second_name'] ?? $user->second_name,
            'third_name'      => $data['user_third_name'] ?? $user->third_name,
            'gender'          => $data['user_gender'] ?? $user->gender,
            'birthday'        => $data['user_birthday'] ? Carbon::parse($data['user_birthday']) : $user->birthday,
            'employment_type' => $data['user_employment_type'] ?? $user->employment_type,
            'email'           => $data['user_email'] ?? $user->email,
            'phone'           => $data['user_phone'] ?? $user->phone,
        ]);
    }
    public function updateAvatar(Request $request, User $user)
    {
        if (!!$request->user_avatar) {
            $avatar = $user->getMedia(User::MEDIA_PREFIX_AVATAR . $user->uuid)->first();

            if ($avatar) {
                $avatar->delete();
            }

            if ($request->file(User::MEDIA_NAME_AVATAR)) {
                $user->modelAddMedia(User::MEDIA_NAME_AVATAR, User::MEDIA_PREFIX_AVATAR . $user->uuid);
            }
        }
    }
    public function updatePassportMainSpread(Request $request, User $user)
    {
        if (isset($request->passport_main_spread)) {
            $passportMainSpread = $user->passport->getMedia(Passport::MEDIA_PREFIX_MAIN_SPREAD . $user->passport->uuid)->first();

            if ($passportMainSpread) {
                $passportMainSpread->delete();
            }

            $user->passport->addMainSpreadMedia();
        }
    }
    public function updatePassportRegistrationSpread(Request $request, User $user)
    {
        if (isset($request->passport_registration_spread)) {
            $passportRegistrationSpread = $user->passport->getMedia(Passport::MEDIA_PREFIX_REGISTRATION_SPREAD . $user->passport->uuid)->first();

            if ($passportRegistrationSpread) {
                $passportRegistrationSpread->delete();
            }

            $user->passport->addRegistrationSpreadMedia();
        }
    }
    public function updatePassportVerificationSpread(Request $request, User $user)
    {
        if (isset($request->passport_verification_spread)) {
            $passportVerificationSpread = $user->passport->getMedia(Passport::MEDIA_PREFIX_VERIFICATION_SPREAD . $user->passport->uuid)->first();

            if ($passportVerificationSpread) {
                $passportVerificationSpread->delete();
            }

            $user->passport->addVerificationSpreadMedia();
        }
    }
    public function updatePassportInfo(Request $request, User $user)
    {
        $user->passport->update([
            'full_name'            => $request->pass_full_name ?? $user->passport->full_name,
            'series'               => $request->pass_series ?? $user->passport->series,
            'number'               => $request->pass_number ?? $user->passport->number,
            'issue_date'           => $request->pass_issue_date ? Carbon::parse($request->pass_issue_date) : $user->passport->issue_date,
            'registration_address' => $request->pass_registration_address ?? $user->passport->registration_address,
            'issue_by'             => $request->pass_issue_by ?? $user->passport->issue_by,
            'department_code'      => $request->pass_department_code ?? $user->passport->department_code,
        ]);
    }
    public function updatePassport(Request $request, User $user)
    {
        if ($user->passport()->exists()) {
            $this->updatePassportInfo($request, $user);
            $this->updatePassportMainSpread($request, $user);
            $this->updatePassportRegistrationSpread($request, $user);
            $this->updatePassportVerificationSpread($request, $user);
        } else {
            $this->createPassport($request, $user);
        }
    }
    public function createPassport(Request $request, User $user)
    {
        $user->passport()->create([
            'full_name'            => $request->pass_full_name,
            'series'               => $request->pass_series,
            'number'               => $request->pass_number,
            'issue_date'           => Carbon::parse($request->pass_issue_date),
            'registration_address' => $request->pass_registration_address,
            'issue_by'             => $request->pass_issue_by,
            'department_code'      => $request->pass_department_code,
        ]);
        $user->passport->addMainSpreadMedia();
        $user->passport->addRegistrationSpreadMedia();
        $user->passport->addVerificationSpreadMedia();
    }
    public function updatePaymentDetails(Request $request, User $user)
    {
        dump(__METHOD__); //DELETE

        // if ($user->paymentDetailsIndividualEntrepreneur) {
        //     $user->paymentDetailsIndividualEntrepreneur->update([
        //         'full_name'                  => $data['ie_full_name'] ?? $user->full_name,
        //         'organization_legal_address' => $data['ie_organization_legal_address'] ?? $user->organization_legal_address,
        //         'inn'                        => $data['ie_inn'] ?? $user->inn,
        //         'ogrn'                       => $data['ie_ogrn'] ?? $user->ogrn,
        //         'transaction_account'        => $data['ie_transaction_account'] ?? $user->transaction_account,
        //         'bank'                       => $data['ie_bank'] ?? $user->bank,
        //         'bank_inn'                   => $data['ie_bank_inn'] ?? $user->bank_inn,
        //         'bank_bic'                   => $data['ie_bank_bic'] ?? $user->bank_bic,
        //         'bank_correspondent_account' => $data['ie_bank_correspondent_account'] ?? $user->bank_correspondent_account,
        //         'bank_legal_address'         => $data['ie_bank_legal_address'] ?? $user->bank_legal_address,
        //     ]);

        //     if (isset($data['ie_confirm_doc'])) {
        //         $confirmDocIE = $user->paymentDetailsIndividualEntrepreneur->getMedia(PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $user->paymentDetailsIndividualEntrepreneur->uuid)->first();

        //         if ($confirmDocIE) {
        //             $confirmDocIE->delete();
        //         }

        //         $user->paymentDetailsIndividualEntrepreneur->modelAddMedia(
        //             PaymentDetailsIndividualEntrepreneur::MEDIA_NAME,
        //             PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $user->paymentDetailsIndividualEntrepreneur->uuid
        //         );
        //     }
        // }

        // if ($user->paymentDetailsSelfEmployed) {
        //     $user->paymentDetailsSelfEmployed->update([
        //         'full_name'             => $data['se_full_name'] ?? $user->full_name,
        //         'transaction_account'   => $data['se_transaction_account'] ?? $user->transaction_account,
        //         'inn'                   => $data['se_inn'] ?? $user->inn,
        //         'swift'                 => $data['se_swift'] ?? $user->swift,
        //         'mailing_address'       => $data['se_mailing_address'] ?? $user->mailing_address,
        //         'bank'                  => $data['se_bank'] ?? $user->bank,
        //         'bic'                   => $data['se_bic'] ?? $user->bic,
        //         'correspondent_account' => $data['se_correspondent_account'] ?? $user->correspondent_account,
        //         'bank_inn'              => $data['se_bank_inn'] ?? $user->bank_inn,
        //         'bank_kpp'              => $data['se_bank_kpp'] ?? $user->bank_kpp,
        //     ]);

        //     if (isset($data['se_confirm_doc'])) {
        //         $confirmDocSE = $user->paymentDetailsSelfEmployed->getMedia(PaymentDetailsSelfEmployed::MEDIA_PREFIX . $user->paymentDetailsSelfEmployed->uuid)->first();

        //         if ($confirmDocSE) {
        //             $confirmDocSE->delete();
        //         }

        //         $user->paymentDetailsSelfEmployed->modelAddMedia(
        //             PaymentDetailsSelfEmployed::MEDIA_NAME,
        //             PaymentDetailsSelfEmployed::MEDIA_PREFIX . $user->paymentDetailsSelfEmployed->uuid
        //         );
        //     }
        // }
    }
}
