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
        dump(__METHOD__); //DELETE

        $user->update([
            'first_name'      => $request->user_first_name ?? $user->first_name,
            'second_name'     => $request->user_second_name ?? $user->second_name,
            'third_name'      => $request->user_third_name ?? $user->third_name,
            'gender'          => $request->user_gender ?? $user->gender,
            'birthday'        => $request->user_birthday ? Carbon::parse($request->user_birthday) : $user->birthday,
            'employment_type' => $request->user_employment_type ?? $user->employment_type,
            'email'           => $request->user_email ?? $user->email,
            'phone'           => $request->user_phone ?? $user->phone,
        ]);
    }
    public function updateAvatar(Request $request, User $user)
    {
        dump(__METHOD__); //DELETE

        if (isset($request->user_avatar)) {
            dump(__METHOD__ . '/handle'); //DELETE

            if ($request->user_avatar === '__null') {
                dump(__METHOD__ . '/delete'); //DELETE
                $user->deleteAvatarMedia();
            }

            if ($request->file(User::MEDIA_NAME_AVATAR)) {
                dump(__METHOD__ . '/update'); //DELETE
                $user->deleteAvatarMedia();
                $user->addAvatarMedia();
            }
        }
    }
    public function updatePassportMainSpread(Request $request, User $user)
    {
        if ($request->passport_main_spread) {
            if ($request->file(Passport::MEDIA_NAME_MAIN_SPREAD)) {
                $user->passport->deleteMainSpreadMedia();
                $user->passport->addMainSpreadMedia();
            }
        } else {
            $user->passport->deleteMainSpreadMedia();
        }
    }
    public function updatePassportRegistrationSpread(Request $request, User $user)
    {
        if ($request->passport_registration_spread) {
            if ($request->file(Passport::MEDIA_NAME_REGISTRATION_SPREAD)) {
                $user->passport->deleteRegistrationSpreadMedia();
                $user->passport->addRegistrationSpreadMedia();
            }
        } else {
            $user->passport->deleteRegistrationSpreadMedia();
        }
    }
    public function updatePassportVerificationSpread(Request $request, User $user)
    {
        if ($request->passport_verification_spread) {
            if ($request->file(Passport::MEDIA_NAME_VERIFICATION_SPREAD)) {
                $user->passport->deleteVerificationSpreadMedia();
                $user->passport->addVerificationSpreadMedia();
            }
        } else {
            $user->passport->deleteVerificationSpreadMedia();
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
    public function createPaymentDetailsIE(Request $request, User $user)
    {
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
    public function updatePaymentDetailsIEInfo(Request $request, User $user)
    {
        $user->paymentDetailsIndividualEntrepreneur->update([
            'full_name'                  => $request->ie_full_name ?? $user->full_name,
            'organization_legal_address' => $request->ie_organization_legal_address ?? $user->organization_legal_address,
            'inn'                        => $request->ie_inn ?? $user->inn,
            'ogrn'                       => $request->ie_ogrn ?? $user->ogrn,
            'transaction_account'        => $request->ie_transaction_account ?? $user->transaction_account,
            'bank'                       => $request->ie_bank ?? $user->bank,
            'bank_inn'                   => $request->ie_bank_inn ?? $user->bank_inn,
            'bank_bic'                   => $request->ie_bank_bic ?? $user->bank_bic,
            'bank_correspondent_account' => $request->ie_bank_correspondent_account ?? $user->bank_correspondent_account,
            'bank_legal_address'         => $request->ie_bank_legal_address ?? $user->bank_legal_address,
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
        if ($request->ie_confirm_doc) {
            if ($request->file(PaymentDetailsIndividualEntrepreneur::MEDIA_NAME)) {
                $this->deletePaymentDetailsIEMedia($user);
                $this->addPaymentDetailsIEMedia($user);
            }
        } else {
            $this->deletePaymentDetailsIEMedia($user);
        }
    }
    public function updatePaymentDetailsIE(Request $request, User $user)
    {
        if ($user->paymentDetailsIndividualEntrepreneur()->exists()) {
            $this->updatePaymentDetailsIEInfo($request, $user);
            $this->updatePaymentDetailsIEMedia($request, $user);

        } else {
            $this->createPaymentDetailsIE($request, $user);
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
        if ($request->agency_contract) {
            if ($request->file(AgencyContract::MEDIA_NAME_AGENCY_CONTRACT)) {
                $this->updateAgencyContract($user);
            }
        } else {
            $user->deleteAgencyContract();
        }
    }
}
