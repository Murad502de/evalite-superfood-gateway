<?php

namespace App\Helpers\User;

use App\Models\Passport;
use App\Models\PaymentDetailsIndividualEntrepreneur;
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
    public function createPaymentDetailsIE(Request $request, User $user)
    {
        dump(__METHOD__); //DELETE
        $user->paymentDetailsIndividualEntrepreneur()->create([
            'full_name'                  => $request->ie_full_name,
            'organization_legal_address' => $request->ie_organization_legal_address,
            'inn'                        => $request->ie_inn,
            'ogrn'                       => $request->ie_ogrn,
            'transaction_account'        => $request->ie_transaction_account,
            'bank'                       => $request->ie_bank,
            'bank_inn'                   => $request->ie_bank_inn,
            'bank_bic'                   => $request->ie_bank_bic,
            'bank_correspondent_account' => $request->ie_bank_correspondent_account,
            'bank_legal_address'         => $request->ie_bank_legal_address,
        ]);
        $user->paymentDetailsIndividualEntrepreneur->modelAddMedia(
            PaymentDetailsIndividualEntrepreneur::MEDIA_NAME,
            PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $user->paymentDetailsIndividualEntrepreneur->uuid
        );
    }
    public function updatePaymentDetailsIE(Request $request, User $user)
    {
        dump(__METHOD__); //DELETE
        dump($user->paymentDetailsIndividualEntrepreneur()->exists()); //DELETE

        if ($user->paymentDetailsIndividualEntrepreneur()->exists()) {
            dump(__METHOD__ . '/exists'); //DELETE
            // $user->paymentDetailsIndividualEntrepreneur->update([
            //     'full_name'                  => $data['ie_full_name'] ?? $user->full_name,
            //     'organization_legal_address' => $data['ie_organization_legal_address'] ?? $user->organization_legal_address,
            //     'inn'                        => $data['ie_inn'] ?? $user->inn,
            //     'ogrn'                       => $data['ie_ogrn'] ?? $user->ogrn,
            //     'transaction_account'        => $data['ie_transaction_account'] ?? $user->transaction_account,
            //     'bank'                       => $data['ie_bank'] ?? $user->bank,
            //     'bank_inn'                   => $data['ie_bank_inn'] ?? $user->bank_inn,
            //     'bank_bic'                   => $data['ie_bank_bic'] ?? $user->bank_bic,
            //     'bank_correspondent_account' => $data['ie_bank_correspondent_account'] ?? $user->bank_correspondent_account,
            //     'bank_legal_address'         => $data['ie_bank_legal_address'] ?? $user->bank_legal_address,
            // ]);

            // if (isset($data['ie_confirm_doc'])) {
            //     $confirmDocIE = $user->paymentDetailsIndividualEntrepreneur->getMedia(PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $user->paymentDetailsIndividualEntrepreneur->uuid)->first();

            //     if ($confirmDocIE) {
            //         $confirmDocIE->delete();
            //     }

            //     $user->paymentDetailsIndividualEntrepreneur->modelAddMedia(
            //         PaymentDetailsIndividualEntrepreneur::MEDIA_NAME,
            //         PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $user->paymentDetailsIndividualEntrepreneur->uuid
            //     );
            // }
        } else {
            dump(__METHOD__ . '/not-exists'); //DELETE
            $this->createPaymentDetailsIE($request, $user);
        }
    }
    public function updatePaymentDetails(Request $request, User $user)
    {
        dump(__METHOD__); //DELETE
        $this->updatePaymentDetailsIE($request, $user);
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
    public function updateAgencyContract(Request $request, User $user)
    {
        dump(__METHOD__); //DELETE

        //FIXME must refactored
        // if (isset($data[AgencyContract::MEDIA_NAME_AGENCY_CONTRACT])) {
        //     Log::info(__METHOD__, ['MEDIA_NAME_AGENCY_CONTRACT']); //DELETE
        //     Log::info(__METHOD__, [$data[AgencyContract::MEDIA_NAME_AGENCY_CONTRACT]]); //DELETE

        //     if ($request->file(AgencyContract::MEDIA_NAME_AGENCY_CONTRACT) === null) {
        //         Log::info(__METHOD__, ['Delete AGENCY_CONTRACT']); //DELETE

        //         if ($user->agencyContract) {
        //             $user->agencyContract->delete();
        //         }
        //     } else {
        //         Log::info(__METHOD__, ['Update or Create AGENCY_CONTRACT']); //DELETE

        //         if ($user->agencyContract) {
        //             Log::info(__METHOD__, ['Update AGENCY_CONTRACT']); //DELETE

        //             $agencyContractMedia = $user->agencyContract->getMedia(AgencyContract::MEDIA_PREFIX_AGENCY_CONTRACT . $user->agencyContract->uuid)->first();

        //             // dump($agencyContractMedia); //DELETE

        //             if ($agencyContractMedia) {
        //                 $agencyContractMedia->delete();
        //             }

        //             if ($request->file(AgencyContract::MEDIA_NAME_AGENCY_CONTRACT)) {
        //                 $user->agencyContract->modelAddMedia(
        //                     AgencyContract::MEDIA_NAME_AGENCY_CONTRACT,
        //                     AgencyContract::MEDIA_PREFIX_AGENCY_CONTRACT . $user->agencyContract->uuid
        //                 );
        //             }
        //         } else {
        //             // dump('create'); //DELETE

        //             Log::info(__METHOD__, ['Create AGENCY_CONTRACT']); //DELETE

        //             $agencyContract = $user->agencyContract()->create();
        //             $agencyContract->modelAddMedia(
        //                 AgencyContract::MEDIA_NAME_AGENCY_CONTRACT,
        //                 AgencyContract::MEDIA_PREFIX_AGENCY_CONTRACT . $agencyContract->uuid
        //             );
        //         }
        //     }

        // } else {
        //     // dump('delete'); //DELETE

        //     // if ($user->agencyContract) {
        //     //     $user->agencyContract->delete();
        //     // }
        // }
    }
}
