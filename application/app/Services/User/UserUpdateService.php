<?php

namespace App\Services\User;

use App\Helpers\User\UserUpdateHelper;
use App\Models\User;
use Carbon\Carbon;
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

    public static function update(User $user, array $data): void
    {
        dump(__METHOD__); //DELETE
        dump($user); //DELETE
        dump($data); //DELETE

        $user->update([
            'first_name'          => isset($data['first_name']) ? $data['first_name'] : $user->first_name,
            'second_name'         => isset($data['second_name']) ? $data['second_name'] : $user->second_name,
            'third_name'          => isset($data['third_name']) ? $data['third_name'] : $user->third_name,
            'gender'              => isset($data['gender']) ? $data['gender'] : $user->gender,
            'birthday'            => isset($data['birthday']) ? Carbon::parse($data['birthday']) : $user->birthday,
            'employment_type'     => isset($data['employment_type']) ? $data['employment_type'] : $user->employment_type,
            'email'               => isset($data['email']) ? $data['email'] : $user->email,
            'phone'               => isset($data['phone']) ? $data['phone'] : $user->phone,
            'password'            => isset($data['password']) ? User::passwordEncrypt($data['password']) : $user->password,
            'verification_status' => isset($data['verification_status']) ? $data['verification_status'] : $user->verification_status,
        ]);
    }
}
