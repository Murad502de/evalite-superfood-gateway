<?php

namespace App\Helpers\User;

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
    public function updatePassport(Request $request, User $user)
    {
        dump(__METHOD__); //DELETE

        // if ($user->passport) {
        //     $user->passport->update([
        //         'full_name'            => $data['pass_full_name'] ?? $user->passport->full_name,
        //         'series'               => $data['pass_series'] ?? $user->passport->series,
        //         'number'               => $data['pass_number'] ?? $user->passport->number,
        //         'issue_date'           => $data['pass_issue_date'] ? Carbon::parse($data['pass_issue_date']) : $user->passport->issue_date,
        //         'registration_address' => $data['pass_registration_address'] ?? $user->passport->registration_address,
        //         'issue_by'             => $data['pass_issue_by'] ?? $user->passport->issue_by,
        //         'department_code'      => $data['pass_department_code'] ?? $user->passport->department_code,
        //     ]);

        //     if (isset($data['passport_main_spread'])) {
        //         $passportMainSpread = $user->passport->getMedia(Passport::MEDIA_PREFIX_MAIN_SPREAD . $user->passport->uuid)->first();

        //         if ($passportMainSpread) {
        //             $passportMainSpread->delete();
        //         }

        //         $user->passport->addMainSpreadMedia();
        //     }

        //     if (isset($data['passport_registration_spread'])) {
        //         $passportRegistrationSpread = $user->passport->getMedia(Passport::MEDIA_PREFIX_REGISTRATION_SPREAD . $user->passport->uuid)->first();

        //         if ($passportRegistrationSpread) {
        //             $passportRegistrationSpread->delete();
        //         }

        //         $user->passport->addRegistrationSpreadMedia();
        //     }

        //     if (isset($data['passport_verification_spread'])) {
        //         $passportVerificationSpread = $user->passport->getMedia(Passport::MEDIA_PREFIX_VERIFICATION_SPREAD . $user->passport->uuid)->first();

        //         if ($passportVerificationSpread) {
        //             $passportVerificationSpread->delete();
        //         }

        //         $user->passport->addVerificationSpreadMedia();
        //     }
        // }
    }
}
