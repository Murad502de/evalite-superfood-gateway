<?php

namespace App\Helpers\User;

use App\Models\AgencyContract;
use App\Models\Passport;
use App\Models\PaymentDetailsIndividualEntrepreneur;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserUpdateHelper
{
    public function update(Request $request, User $user)
    {
        $user->update([
            'first_name'          => $request->user_first_name ?? $user->first_name,
            'second_name'         => $request->user_second_name ?? $user->second_name,
            'third_name'          => $request->user_third_name ?? $user->third_name,
            'gender'              => $request->user_gender ?? $user->gender,
            'birthday'            => $request->user_birthday ? Carbon::parse($request->user_birthday) : $user->birthday,
            'employment_type'     => $request->user_employment_type ?? $user->employment_type,
            'email'               => $request->user_email ?? $user->email,
            'phone'               => $request->user_phone ?? $user->phone,
            'password'            => $request->user_password ? User::passwordEncrypt($request->user_password) : $user->password,
            'verification_status' => $request->user_verification_status ?? $user->verification_status,
        ]);
    }
    public function updateAvatar(Request $request, User $user)
    {
        if (isset($request->user_avatar)) {
            if ($request->user_avatar === '__null') {
                $user->deleteAvatarMedia();
            }

            if ($request->file(User::MEDIA_NAME_AVATAR)) {
                $user->deleteAvatarMedia();
                $user->addAvatarMedia();
            }
        }
    }
    public function updatePassportMainSpread(Request $request, User $user)
    {
        if (isset($request->passport_main_spread)) {
            if ($request->passport_main_spread === '__null') {
                $user->passport->deleteMainSpreadMedia();
            }

            if ($request->file(Passport::MEDIA_NAME_MAIN_SPREAD)) {
                $user->passport->deleteMainSpreadMedia();
                $user->passport->addMainSpreadMedia();
            }
        }
    }
    public function updatePassportRegistrationSpread(Request $request, User $user)
    {
        if (isset($request->passport_registration_spread)) {
            if ($request->passport_registration_spread === '__null') {
                $user->passport->deleteRegistrationSpreadMedia();
            }

            if ($request->file(Passport::MEDIA_NAME_REGISTRATION_SPREAD)) {
                $user->passport->deleteRegistrationSpreadMedia();
                $user->passport->addRegistrationSpreadMedia();
            }
        }
    }
    public function updatePassportVerificationSpread(Request $request, User $user)
    {
        if (isset($request->passport_verification_spread)) {
            if ($request->passport_verification_spread === '__null') {
                $user->passport->deleteVerificationSpreadMedia();
            }

            if ($request->file(Passport::MEDIA_NAME_VERIFICATION_SPREAD)) {
                $user->passport->deleteVerificationSpreadMedia();
                $user->passport->addVerificationSpreadMedia();
            }
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
    public function createPassport(Request $request, User $user)
    {
        if (
            $request->pass_full_name &&
            $request->pass_series &&
            $request->pass_number &&
            Carbon::parse($request->pass_issue_date) &&
            $request->pass_registration_address &&
            $request->pass_issue_by &&
            $request->pass_department_code &&
            $request->hasFile(Passport::MEDIA_NAME_MAIN_SPREAD) &&
            $request->hasFile(Passport::MEDIA_NAME_REGISTRATION_SPREAD) &&
            $request->hasFile(Passport::MEDIA_NAME_VERIFICATION_SPREAD)
        ) {
            $user->passport()->create([
                'full_name'            => $request->pass_full_name,
                'series'               => $request->pass_series,
                'number'               => $request->pass_number,
                'issue_date'           => Carbon::parse($request->pass_issue_date),
                'registration_address' => $request->pass_registration_address,
                'issue_by'             => $request->pass_issue_by,
                'department_code'      => $request->pass_department_code,
            ]);

            if ($request->hasFile(Passport::MEDIA_NAME_MAIN_SPREAD)) {
                $user->passport->addMainSpreadMedia();
            }

            if ($request->hasFile(Passport::MEDIA_NAME_REGISTRATION_SPREAD)) {
                $user->passport->addRegistrationSpreadMedia();
            }

            if ($request->hasFile(Passport::MEDIA_NAME_VERIFICATION_SPREAD)) {
                $user->passport->addVerificationSpreadMedia();
            }
        }
    }
    public function updatePassport(Request $request, User $user)
    {
        if ($user->passport()->exists()) {
            $this->updatePassportInfo($request, $user);
            $this->updatePassportMainSpread($request, $user);
            $this->updatePassportRegistrationSpread($request, $user);
            $this->updatePassportVerificationSpread($request, $user);
        } else {
            $this->createPassport($request, $user); //FIXME
        }
    }
    public function createPaymentDetailsIE(Request $request, User $user)
    {
        if (
            $request->ie_full_name &&
            $request->ie_organization_legal_address &&
            $request->ie_inn &&
            $request->ie_ogrn &&
            $request->ie_transaction_account &&
            $request->ie_bank &&
            $request->ie_bank_inn &&
            $request->ie_bank_bic &&
            $request->ie_bank_correspondent_account &&
            $request->ie_bank_legal_address &&
            $request->hasFile(PaymentDetailsIndividualEntrepreneur::MEDIA_NAME)
        ) {
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

            if ($request->hasFile(PaymentDetailsIndividualEntrepreneur::MEDIA_NAME)) {
                $user->paymentDetailsIndividualEntrepreneur->modelAddMedia(
                    PaymentDetailsIndividualEntrepreneur::MEDIA_NAME,
                    PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $user->paymentDetailsIndividualEntrepreneur->uuid
                );
            }
        }
    }
    public function updatePaymentDetailsIEInfo(Request $request, User $user)
    {
        $user->paymentDetailsIndividualEntrepreneur->update([
            'full_name'                  => $request->ie_full_name ?? $user->paymentDetailsIndividualEntrepreneur->full_name,
            'organization_legal_address' => $request->ie_organization_legal_address ?? $user->paymentDetailsIndividualEntrepreneur->organization_legal_address,
            'inn'                        => $request->ie_inn ?? $user->paymentDetailsIndividualEntrepreneur->inn,
            'ogrn'                       => $request->ie_ogrn ?? $user->paymentDetailsIndividualEntrepreneur->ogrn,
            'transaction_account'        => $request->ie_transaction_account ?? $user->paymentDetailsIndividualEntrepreneur->transaction_account,
            'bank'                       => $request->ie_bank ?? $user->paymentDetailsIndividualEntrepreneur->bank,
            'bank_inn'                   => $request->ie_bank_inn ?? $user->paymentDetailsIndividualEntrepreneur->bank_inn,
            'bank_bic'                   => $request->ie_bank_bic ?? $user->paymentDetailsIndividualEntrepreneur->bank_bic,
            'bank_correspondent_account' => $request->ie_bank_correspondent_account ?? $user->paymentDetailsIndividualEntrepreneur->bank_correspondent_account,
            'bank_legal_address'         => $request->ie_bank_legal_address ?? $user->paymentDetailsIndividualEntrepreneur->bank_legal_address,
        ]);
    }
    public function addPaymentDetailsIEMedia(User $user)
    {
        $user->paymentDetailsIndividualEntrepreneur->modelAddMedia(
            PaymentDetailsIndividualEntrepreneur::MEDIA_NAME,
            PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $user->paymentDetailsIndividualEntrepreneur->uuid
        );
    }
    public function deletePaymentDetailsIEMedia(User $user)
    {
        $confirmDocIEMedia = $user->paymentDetailsIndividualEntrepreneur
            ->getMedia(PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $user->paymentDetailsIndividualEntrepreneur->uuid)
            ->first();

        if ($confirmDocIEMedia) {
            $confirmDocIEMedia->delete();
        }
    }
    public function updatePaymentDetailsIEMedia(Request $request, User $user)
    {
        if (isset($request->ie_confirm_doc)) {
            if ($request->ie_confirm_doc === '__null') {
                $this->deletePaymentDetailsIEMedia($user);
            }

            if ($request->file(PaymentDetailsIndividualEntrepreneur::MEDIA_NAME)) {
                $this->deletePaymentDetailsIEMedia($user);
                $this->addPaymentDetailsIEMedia($user);
            }
        }
    }
    public function updatePaymentDetailsIE(Request $request, User $user)
    {
        if ($user->paymentDetailsIndividualEntrepreneur()->exists()) {
            $this->updatePaymentDetailsIEInfo($request, $user);
            $this->updatePaymentDetailsIEMedia($request, $user);

        } else {
            $this->createPaymentDetailsIE($request, $user); //FIXME
        }
    }
    public function updatePaymentDetails(Request $request, User $user)
    {
        $this->updatePaymentDetailsIE($request, $user);
    }
    public function updateAgencyContractMedia(User $user)
    {
        $user->agencyContract->deleteAgencyContractMedia();
        $user->agencyContract->addAgencyContractMedia();
    }
    public function updateAgencyContract(User $user)
    {
        if ($user->agencyContract()->exists()) {
            $this->updateAgencyContractMedia($user);
        } else {
            $user->addAgencyContract();
        }
    }
    public function handleAgencyContract(Request $request, User $user)
    {
        if (isset($request->agency_contract)) {
            if ($request->agency_contract === '__null') {
                $user->deleteAgencyContract();
            }

            if ($request->file(AgencyContract::MEDIA_NAME_AGENCY_CONTRACT)) {
                $this->updateAgencyContract($user);
            }
        }
    }
}
