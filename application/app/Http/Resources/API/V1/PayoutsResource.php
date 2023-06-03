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
        $price = 0;

        foreach ($this->sales as $sale) {
            $price += ($sale->lead->price / 100) * $sale->percent;
        }

        return Arr::except(array_merge(parent::toArray($request), [
            'price'      => floor($price),
            'created_at' => $this->created_at,
            'user'       => new UsersDetailResource($this->user),
        ]), ['sales']);
    }
}
