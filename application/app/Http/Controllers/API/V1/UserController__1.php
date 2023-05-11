<?php

namespace App\Http\Controllers\API\V1;

use App\Events\passwordResetCodeRequested;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\UserCreateRequest__1;
use App\Http\Requests\API\V1\UserPasswordResetConfirmRequest__1;
use App\Http\Requests\API\V1\UserPasswordResetRequest__1;
use App\Http\Requests\API\V1\UserPasswordUpdateRequest__1;
use App\Http\Resources\API\V1\UsersMyResource;
use App\Http\Resources\API\V1\UsersSalesResource;
use App\Models\PasswordReset;
use App\Models\Payout;
use App\Models\User;
use App\Traits\GenerateCodeTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class UserController__1 extends Controller
{
    use GenerateCodeTrait;

    public function create(UserCreateRequest__1 $request)
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
    public function getAgencyContract(User $user)
    {
        return $user->generateAgencyContract()->stream();
    }
    public function getSales(User $user)
    {
        return new UsersSalesResource($user);
    }
    public function payoutSales(User $user)
    {
        $sales       = $user->sales()->whereStatus(config('constants.sales.statuses.waiting'))->get();
        $total_price = 0;

        foreach ($sales as $sale) {
            $total_price += ($sale->lead->price / 100) * $sale->percent;
        }

        if (!($total_price >= 30000)) {
            return response()->json([
                'status'  => false,
                'message' => 'The minimum total price for payout has not been reached',
            ], Response::HTTP_OK);
        }

        $payout = Payout::create([
            'status' => config('constants.payouts.statuses.processing'),
        ]);

        foreach ($sales as $sale) {
            $sale->update([
                'status'    => config('constants.sales.statuses.processing'),
                'payout_id' => $payout->id,
            ]);
        }

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
}
