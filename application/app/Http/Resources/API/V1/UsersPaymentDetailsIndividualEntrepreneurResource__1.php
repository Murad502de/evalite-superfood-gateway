<?php

namespace App\Http\Resources\API\V1;

use App\Models\PaymentDetailsIndividualEntrepreneur;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersPaymentDetailsIndividualEntrepreneurResource__1 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'ie_confirm_doc' => $this->getMedia(PaymentDetailsIndividualEntrepreneur::MEDIA_PREFIX . $this->uuid)->first()->getUrl(),
        ]);
    }
}
