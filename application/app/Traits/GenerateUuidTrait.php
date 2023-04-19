<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait GenerateUuidTrait
{
    public function generateUuid(): string
    {
        return Uuid::uuid4()->toString();
    }
}
