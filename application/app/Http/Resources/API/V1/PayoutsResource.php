<?php

namespace App\Http\Resources\API\V1;

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

        return Arr::except(array_merge(parent::toArray($request), [
            'uuid'       => $this->uuid,
            // 'created_at' => $this->created_at,
            // 'price'      => floor($price),
            'user'       => new UsersDetailResource($this->user),
        ]), [
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
