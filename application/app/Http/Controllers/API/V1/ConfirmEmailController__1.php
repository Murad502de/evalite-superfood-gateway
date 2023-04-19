<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Mail\User\ConfirmMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ConfirmEmailController__1 extends Controller
{
    public function confirm()
    {
        return 'confirm';
    }
    public function code(Request $request)
    {
        Mail::to($request->email)->send(new ConfirmMail(1287));

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
}
