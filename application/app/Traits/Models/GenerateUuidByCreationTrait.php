<?php

namespace App\Traits\Models;

use Ramsey\Uuid\Uuid;

trait GenerateUuidByCreationTrait
{
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
