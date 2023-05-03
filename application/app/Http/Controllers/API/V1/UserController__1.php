<?php

namespace App\Http\Controllers\API\V1;

use App\Events\passwordResetCodeRequested;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\UserPasswordResetConfirmRequest__1;
use App\Http\Requests\API\V1\UserPasswordResetRequest__1;
use App\Http\Requests\API\V1\UserPasswordUpdateRequest__1;
use App\Http\Resources\API\V1\UsersMyResource;
use App\Models\PasswordReset;
use App\Models\User;
use App\Traits\GenerateCodeTrait;
use App\Traits\PdfTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

//DELETE

class UserController__1 extends Controller
{
    use GenerateCodeTrait, PdfTrait;

    public function create(Request $request)
    {
        $user = User::createNew($request);

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function my()
    {
        return new UsersMyResource(Config::get('user'));
    }
    public function check(User $user)
    {
        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function delete(User $user)
    {
        if ($user->passport) {
            $user->passport->delete();
        }
        if ($user->paymentDetailsIndividualEntrepreneur) {
            $user->paymentDetailsIndividualEntrepreneur->delete();
        }
        if ($user->paymentDetailsSelfEmployed) {
            $user->paymentDetailsSelfEmployed->delete();
        }

        $user->delete();

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function passwordUpdate(UserPasswordUpdateRequest__1 $request)
    {
        $result = User::whereEmail($request->email)->update([
            'password' => User::passwordEncrypt($request->password),
        ]);

        if ($result) {
            PasswordReset::whereEmail($request->email)->delete();
            return response()->json(['message' => 'success'], Response::HTTP_OK);
        }

        return response()->json(['message' => 'error'], Response::HTTP_BAD_REQUEST);
    }
    public function passwordReset(UserPasswordResetRequest__1 $request)
    {
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $request->email],
            ['confirm_code' => $this->generateCode()],
        );

        event(new passwordResetCodeRequested($passwordReset->email, $passwordReset->confirm_code));

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function passwordResetConfirm(UserPasswordResetConfirmRequest__1 $request)
    {
        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }

    public function test()
    {
        $user = User::whereUuid('37b624ff-0b31-4f98-9c8c-3db95911c42a')->first();
        // $user = User::whereUuid('0018b00d-87ec-48eb-9fba-1642f92aff77')->first();
        // event(new UserRegisteredEvent($user));
        $data = $user->getAgencyContractData();
        return $this->loadPdfFromView('agency_contract', $data)->stream();
    }
}
