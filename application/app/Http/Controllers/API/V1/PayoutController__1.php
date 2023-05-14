<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\PayoutsResource;
use App\Models\Payout;
use Illuminate\Http\Response;

class PayoutController__1 extends Controller
{
    public function getPayouts()
    {
        return PayoutsResource::collection(Payout::all());
    }
    public function getPayout(Payout $payout)
    {
        return new PayoutsResource($payout);
    }
    public function payout(Payout $payout)
    {
        $payoutUpdateResult = $payout->update([
            'status' => config('constants.payouts.statuses.completed'),
        ]);
        $payoutSalesUpdateResult = $payout->sales()->update([
            'status' => config('constants.sales.statuses.closed'),
        ]);

        return response()->json([
            'status'  => $payoutUpdateResult && $payoutSalesUpdateResult,
            'message' => $payoutUpdateResult && $payoutSalesUpdateResult ? 'success' : 'error',
        ], Response::HTTP_OK);
    }
}
