<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class SalesBonussesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $partner_name     = '';
        $sale_direct_user = null;
        $sales_direct     = $this->lead->sales->where('is_direct', true);

        if (count($sales_direct)) {
            $sale_direct_user = $sales_direct[0]->user;
            $partner_name     = $sale_direct_user->second_name . ' ' . $sale_direct_user->first_name . ' ' . $sale_direct_user->third_name;
        }

        return Arr::except(array_merge(parent::toArray($request), [
            'name'         => $this->lead->name,
            'price'        => floor(($this->lead->price / 100) * $this->percent),
            'partner_name' => $partner_name,
        ]), ['lead']);
    }
}
