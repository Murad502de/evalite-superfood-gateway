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
        // $this->helper->updatePassport($request, $user); //TODO
        $this->helper->updatePaymentDetails($request, $user);

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
