<?php

namespace App\Http\Resources\API\V1;

use App\Models\Payout;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class PayoutsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $price = 0;

        // foreach ($this->sales as $sale) {
        //     $price += ($sale->lead->price / 100) * $sale->percent;
        // }

        $receipt = $this->getMedia(Payout::MEDIA_PREFIX_RECEIPT . $this->uuid)->first();

        return Arr::except(array_merge(parent::toArray($request), [
            'uuid'        => $this->uuid,
            'receipt_url' => $receipt ? $receipt->getUrl() : null,

            // 'tets_path'   => $receipt->getPath(), //DELETE
            // 'test___mime_type' => $receipt->mime_type, //DELETE

            'user'        => new UsersDetailResource($this->user),
            // 'created_at' => $this->created_at,
            // 'price'      => floor($price),
        ]), [
            'media',
            'sales',
            'role_id',
            'first_name',
            'second_name',
            'third_name',
            'gender',
            'birthday',
            'employment_type',
            'password',
            'token',
            'phone',
            'invite_code',
            'individual_code',
            'promo_code',
            'verification_status',
        ]);
    }
}
