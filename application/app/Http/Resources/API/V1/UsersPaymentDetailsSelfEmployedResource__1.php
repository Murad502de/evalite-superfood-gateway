<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\PaymentDetailsSelfEmployed;

class UsersPaymentDetailsSelfEmployedResource__1 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'se_confirm_doc' => $this->getMedia(PaymentDetailsSelfEmployed::MEDIA_PREFIX . $this->uuid)->first()->getUrl(),
        ]);
    }
}