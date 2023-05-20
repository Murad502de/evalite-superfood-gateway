<?php

namespace App\Http\Resources\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'avatar'                                  => $this->getMedia(User::MEDIA_PREFIX_AVATAR . $this->uuid)->first()->getUrl(),
            'role'                                    => $this->role->code,
            'passport'                                => $this->passport ? new UsersPassportResource__1($this->passport) : null,
            'payment_details_individual_entrepreneur' => $this->paymentDetailsIndividualEntrepreneur,
            'payment_details_self_employed'           => $this->paymentDetailsSelfEmployed,
            'agency_contract'                         => $this->agencyContract,
        ]);
    }
}
