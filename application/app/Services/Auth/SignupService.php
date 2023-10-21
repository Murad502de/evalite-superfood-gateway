<?php

namespace App\Services\Auth;

// use App\Events\UserRegisteredEvent;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SignupService
{
    public function __invoke(Request $request): User
    {
        $data = $request->all();
        $user = User::create([
            'role_id'             => $data['user_role_uuid'] ?? Role::whereIsDefault(true)->first()->id,
            'first_name'          => $data['user_first_name'],
            'second_name'         => $data['user_second_name'],
            'third_name'          => $data['user_third_name'],
            'gender'              => $data['user_gender'],
            'birthday'            => Carbon::parse($data['user_birthday']),
            'employment_type'     => $data['user_employment_type'],
            'email'               => $data['user_email'],
            'password'            => User::passwordEncrypt($data['user_password']),
            'token'               => User::generateUserToken(),
            'phone'               => $data['user_phone'],
            'invite_code'         => Str::upper(Str::random(6)),
            'individual_code'     => Str::upper(Str::random(6)),
            'promo_code'          => $data['user_promo_code'],
            'verification_status' => config('constants.user.verification_statuses.waiting'),
        ]);

        if ($request->file(User::MEDIA_NAME_AVATAR)) {
            $user->addAvatarMedia();
        }

        return $user;
    }
}
