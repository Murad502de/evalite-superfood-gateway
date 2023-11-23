<?php

namespace App\Services\User;

// use App\Models\AgencyContract;
// use App\Models\Passport;
// use App\Models\PaymentDetailsIndividualEntrepreneur;
// use App\Models\PaymentDetailsSelfEmployed;
use App\Helpers\User\UserUpdateHelper;
// use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class UserUpdateService
{
    private $helper;

    public function __construct()
    {
        $this->helper = new UserUpdateHelper();
    }

    public function __invoke(User $user, Request $request): void
    {
        $data = $request->all();
        // $this->helper->update($user, $data); //TODO
        // $this->helper->updateAvatar($request, $user); //TODO
        $this->helper->updatePassport($request, $user);

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

        // //FIXME must refactored
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
