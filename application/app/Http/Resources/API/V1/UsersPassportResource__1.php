<?php

namespace App\Http\Resources\API\V1;

use App\Models\Passport;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersPassportResource__1 extends JsonResource
{
    public function toArray(Request $request): array
    {
        $passport_main_spread         = $this->getMedia(Passport::MEDIA_PREFIX_MAIN_SPREAD . $this->uuid)->first();
        $passport_registration_spread = $this->getMedia(Passport::MEDIA_PREFIX_REGISTRATION_SPREAD . $this->uuid)->first();
        $passport_verification_spread = $this->getMedia(Passport::MEDIA_PREFIX_VERIFICATION_SPREAD . $this->uuid)->first();

        return array_merge(parent::toArray($request), [
            'passport_main_spread'         => $passport_main_spread ? $passport_main_spread->getUrl() : null,
            'passport_registration_spread' => $passport_registration_spread ? $passport_registration_spread->getUrl() : null,
            'passport_verification_spread' => $passport_verification_spread ? $passport_verification_spread->getUrl() : null,
        ]);
    }
}
