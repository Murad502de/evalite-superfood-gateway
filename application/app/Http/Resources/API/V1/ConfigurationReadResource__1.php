<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ConfigurationReadResource__1 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $percentage_levels = [];

        foreach ($this->configurationPercentageLevels as $configurationPercentageLevel) {
            $percentage_levels[] = [
                'uuid'       => $configurationPercentageLevel['uuid'],
                'level'      => $configurationPercentageLevel['id'],
                'percentage' => $configurationPercentageLevel['percentage'],
            ];
        }

        return Arr::except(array_merge(parent::toArray($request), [
            'percentage_levels' => $percentage_levels,
        ]), ['configuration_percentage_levels']);
    }
}
