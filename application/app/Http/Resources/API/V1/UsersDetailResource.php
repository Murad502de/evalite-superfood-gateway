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
        $passport                             = $this->passport ? new UsersPassportResource__1($this->passport) : null;
        $paymentDetailsIndividualEntrepreneur = $this->paymentDetailsIndividualEntrepreneur ? new UsersPaymentDetailsIndividualEntrepreneurResource__1($this->paymentDetailsIndividualEntrepreneur) : null;
        $paymentDetailsSelfEmployed           = $this->paymentDetailsSelfEmployed ? new UsersPaymentDetailsSelfEmployedResource__1($this->paymentDetailsSelfEmployed) : null;
        $agencyContract                       = $this->agencyContract ? new UsersAgencyContractResource__1($this->agencyContract) : null;

        return array_merge(parent::toArray($request), [
            'avatar'                                  => $this->getMedia(User::MEDIA_PREFIX_AVATAR . $this->uuid)->first()->getUrl(),
            'role'                                    => $this->role->code,
            'passport'                                => $passport,
            'payment_details_individual_entrepreneur' => $paymentDetailsIndividualEntrepreneur,
            'payment_details_self_employed'           => $paymentDetailsSelfEmployed,
            'agency_contract'                         => $agencyContract,
        ]);
    }
}
