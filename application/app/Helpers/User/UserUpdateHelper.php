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
}
