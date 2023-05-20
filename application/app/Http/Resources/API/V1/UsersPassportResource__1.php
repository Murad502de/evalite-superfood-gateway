<?php

namespace App\Http\Resources\API\V1;

use App\Models\Passport;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersPassportResource__1 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'passport_main_spread'         => $this->getMedia(Passport::MEDIA_PREFIX_MAIN_SPREAD . $this->uuid)->first()->getUrl(),
            'passport_registration_spread' => $this->getMedia(Passport::MEDIA_PREFIX_REGISTRATION_SPREAD . $this->uuid)->first()->getUrl(),
            'passport_verification_spread' => $this->getMedia(Passport::MEDIA_PREFIX_VERIFICATION_SPREAD . $this->uuid)->first()->getUrl(),
        ]);
    }
}
