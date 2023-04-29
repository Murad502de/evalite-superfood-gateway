<?php

namespace App\Http\Controllers\API\V1;

use App\Events\emailVerificationCodeRequested;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\ConfirmEmailConfirmRequest__1;
use App\Models\ConfirmEmail;
use App\Traits\GenerateCodeTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConfirmEmailController__1 extends Controller
{
    use GenerateCodeTrait;

    public function confirm(ConfirmEmailConfirmRequest__1 $request)
    {
        ConfirmEmail::whereEmail($request->email)
            ->delete();

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function code(Request $request)
    {
        $confirmEmail = ConfirmEmail::updateOrCreate(
            ['email' => $request->email],
            ['confirm_code' => $this->generateCode()],
        );

        event(new emailVerificationCodeRequested($confirmEmail->email, $confirmEmail->confirm_code));

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
}
