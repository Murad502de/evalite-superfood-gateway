<?php

namespace App\Services\User;

use App\Helpers\User\UserUpdateHelper;
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
        $this->helper->update($request, $user);
        $this->helper->updateAvatar($request, $user);
        $this->helper->updatePassport($request, $user);
        $this->helper->updatePaymentDetails($request, $user);
        $this->helper->handleAgencyContract($request, $user);
    }
}
