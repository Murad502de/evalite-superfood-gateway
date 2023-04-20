<?php

namespace App\Traits;

trait ModelAddMediaTrait
{
    private function modalAddMedia(string $mediaFromRequest, string $mediaCollection): void
    {
        $this->addMediaFromRequest($mediaFromRequest)
            ->sanitizingFileName(function ($fileName) {
                return strtolower($fileName);
            })
            ->toMediaCollection($mediaCollection);
    }
}
