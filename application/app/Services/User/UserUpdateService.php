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
        // $this->helper->updatePaymentDetails($request, $user); //TODO
        $this->helper->handleAgencyContract($request, $user); //TODO
    }
}
