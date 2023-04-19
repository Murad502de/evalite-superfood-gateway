<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Mail\User\ConfirmMail;
use App\Models\ConfirmEmail;
use App\Traits\GenerateCodeTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ConfirmEmailController__1 extends Controller
{
    use GenerateCodeTrait;

    public function confirm(Request $request)
    {
        dump($request->all());

        return 'confirm';
    }
    public function code(Request $request)
    {
        $confirmEmail = ConfirmEmail::create([
            'email'        => $request->email,
            'confirm_code' => $this->generateCode(),
        ]);

        Mail::to($confirmEmail->email)->send(new ConfirmMail($confirmEmail->confirm_code));

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
}
