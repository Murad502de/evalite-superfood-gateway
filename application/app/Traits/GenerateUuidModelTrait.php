<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait GenerateUuidModelTrait
{
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
