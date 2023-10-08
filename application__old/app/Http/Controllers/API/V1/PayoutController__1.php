<?php

namespace App\Http\Controllers\API\V1;

use App\Events\PayoutApprovedEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\PayoutsResource;
use App\Models\Payout;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PayoutController__1 extends Controller
{
    public function getPayouts(Request $request)
    {
        $request_params           = $request->all();
        $filter_date_from         = isset($request_params['filter_date_from']) ? Carbon::createFromFormat('d.m.Y', $request->get('filter_date_from'))->startOfDay()->toDateTimeString() : null;
        $filter_date_to           = isset($request_params['filter_date_to']) ? Carbon::createFromFormat('d.m.Y', $request->get('filter_date_to'))->endOfDay()->toDateTimeString() : null;
        $filter_partner_email     = isset($request_params['filter_partner_email']) ? $request_params['filter_partner_email'] : null;
        $filter_partner_full_name = isset($request_params['filter_partner_full_name']) ? $request_params['filter_partner_full_name'] : null;
        $filter_status            = isset($request_params['filter_status']) ? $request_params['filter_status'] : null;
        $order_by                 = isset($request_params['order_by']) ? $request_params['order_by'] : 'payouts.created_at';
        $ordering_rule            = isset($request_params['ordering_rule']) ? $request_params['ordering_rule'] : 'desc';
        $payouts                  = Payout::join('users', 'payouts.user_id', '=', 'users.id')
            ->addSelect(DB::raw("*, payouts.created_at as created_at, payouts.uuid as uuid, concat(second_name, ' ', first_name, ' ', third_name) as partner_full_name"))
            ->when($filter_date_from, function ($query) use ($filter_date_from) {
                $query->where('payouts.created_at', '>=', $filter_date_from);
            })
            ->when($filter_date_to, function ($query) use ($filter_date_to) {
                $query->where('payouts.created_at', '<=', $filter_date_to);
            })
            ->when($filter_partner_email, function ($query) use ($filter_partner_email) {
                $query->where('users.email', 'ILIKE', '%' . $filter_partner_email . '%');
            })
            ->when($filter_partner_full_name, function ($query) use ($filter_partner_full_name) {
                $users = User::whereHas('role', function ($query) {
                    $query->whereNot(function ($query) {
                        $query->where('code', config('constants.user.roles.admin'));
                        $query->whereVerificationStatus(config('constants.user.verification_statuses.completed'));
                    });
                })->get();
                $usersTarget = [];

                foreach ($users as $user) {
                    $userFullName = $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name;
                    if (preg_match("/" . mb_strtolower($filter_partner_full_name) . "/i", mb_strtolower($userFullName))) {
                        $usersTarget[] = $user;
                    }
                }

                if (!count($usersTarget)) {
                    $query->where('payouts.user_id', null);
                } else {
                    foreach ($usersTarget as $key => $userTarget) {
                        if (!$key) {
                            $query->where('payouts.user_id', $userTarget->id);
                        } else {
                            $query->orWhere('payouts.user_id', $userTarget->id);
                        }
                    }
                }
            })
            ->when($filter_status, function ($query) use ($filter_status) {
                $query->whereStatus($filter_status);
            })
            ->when($order_by, function ($query) use ($order_by, $ordering_rule) {
                $query->orderBy($order_by, $ordering_rule);
            })
            ->paginate($request->per_page ?? 5);

        return PayoutsResource::collection($payouts);
    }
    public function getPayout(Payout $payout)
    {
        return new PayoutsResource($payout);
    }
    public function payout(Payout $payout, Request $request)
    {
        if ($payout->status === config('constants.payouts.statuses.processing')) {
            if ($request->file(Payout::MEDIA_NAME_RECEIPT)) {
                $receipt = $payout->getMedia(Payout::MEDIA_PREFIX_RECEIPT . $payout->uuid)->first();

                if ($receipt) {
                    $receipt->delete();
                }

                $payout->modelAddMedia(Payout::MEDIA_NAME_RECEIPT, Payout::MEDIA_PREFIX_RECEIPT . $payout->uuid);
            }

            $payoutUpdateResult = $payout->update([
                'status' => config('constants.payouts.statuses.completed'),
            ]);
            $payoutSalesUpdateResult = $payout->sales()->update([
                'status' => config('constants.sales.statuses.closed'),
            ]);

            event(new PayoutApprovedEvent($payout->user, $payout));

            return response()->json([
                'status'  => $payoutUpdateResult && $payoutSalesUpdateResult,
                'message' => $payoutUpdateResult && $payoutSalesUpdateResult ? 'success' : 'error',
            ], Response::HTTP_OK);
        }

        return response()->json(['message' => 'status should be processing'], Response::HTTP_BAD_REQUEST);
    }
}
