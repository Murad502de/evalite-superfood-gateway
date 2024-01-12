<?php

namespace App\Helpers\User;

use App\Models\User;

class UserVerificationStatusHelper
{
    public static function isStatusExist(string $status): bool
    {
        switch ($status) {
            case User::VERIFICATION_STATUS_CODE_VERIFIED:
            case User::VERIFICATION_STATUS_CODE_NOT_VERIFIED:
            case User::VERIFICATION_STATUS_CODE_WAITING:
            case User::VERIFICATION_STATUS_CODE_REJECTED:
            case User::VERIFICATION_STATUS_CODE_TO_UPDATE:
                return true;
            default:
                return false;
        }
    }
}
