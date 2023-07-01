<?php

namespace App\Http\Controllers\API\V1;

use App\Events\passwordResetCodeRequested;
use App\Events\UserApprovedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\UserCreateRequest__1;
use App\Http\Requests\API\V1\UserPasswordResetConfirmRequest__1;
use App\Http\Requests\API\V1\UserPasswordResetRequest__1;
use App\Http\Requests\API\V1\UserPasswordUpdateRequest__1;
use App\Http\Requests\API\V1\UserStatusVerificationSetRequest__1;
use App\Http\Resources\API\V1\PayoutsResource;
use App\Http\Resources\API\V1\SalesBonussesResource;
use App\Http\Resources\API\V1\SalesResource;
use App\Http\Resources\API\V1\UsersDetailResource;
use App\Http\Resources\API\V1\UsersResource;
use App\Models\Configuration;
use App\Models\Lead;
use App\Models\PasswordReset;
use App\Models\Payout;
use App\Models\Sale;
use App\Models\User;
use App\Traits\GenerateCodeTrait;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class UserController__1 extends Controller
{
    use GenerateCodeTrait;

    public function users(Request $request)
    {
        $request_params   = $request->all();
        $filter_status    = isset($request_params['filter_status']) ? $request_params['filter_status'] : null;
        $filter_date_from = isset($request_params['filter_date_from']) ? Carbon::createFromFormat('d.m.Y', $request->get('filter_date_from'))->startOfDay()->toDateTimeString() : null;
        $filter_date_to   = isset($request_params['filter_date_to']) ? Carbon::createFromFormat('d.m.Y', $request->get('filter_date_to'))->endOfDay()->toDateTimeString() : null;
        $filter_email     = isset($request_params['filter_email']) ? $request_params['filter_email'] : null;
        $filter_full_name = isset($request_params['filter_full_name']) ? $request_params['filter_full_name'] : null;
        $order_by         = isset($request_params['order_by']) ? $request_params['order_by'] : 'created_at';
        $ordering_rule    = isset($request_params['ordering_rule']) ? $request_params['ordering_rule'] : 'desc';
        $users            = User::whereHas('role', function ($query) {
            $query->whereNot(function ($query) {
                $query->where('code', config('constants.user.roles.admin'));
            });
        })
            ->when($filter_status, function ($query) use ($filter_status) {
                $query->whereVerificationStatus($filter_status);
            })
            ->addSelect(DB::raw("*, concat(second_name, ' ', first_name, ' ', third_name) as full_name"))
            ->when($filter_date_from, function ($query) use ($filter_date_from) {
                $query->where('created_at', '>=', $filter_date_from);
            })
            ->when($filter_date_to, function ($query) use ($filter_date_to) {
                $query->where('created_at', '<=', $filter_date_to);
            })
            ->when($filter_email, function ($query) use ($filter_email) {
                $query->where('email', 'ILIKE', '%' . $filter_email . '%');
            })
            ->when($filter_full_name, function ($query) use ($filter_full_name, $filter_status) {
                $users = User::whereHas('role', function ($query) {
                    $query->whereNot(function ($query) {
                        $query->where('code', config('constants.user.roles.admin'));
                    });
                })
                    ->when($filter_status, function ($query) use ($filter_status) {
                        $query->whereVerificationStatus($filter_status);
                    })
                    ->get();
                $usersTarget = [];

                foreach ($users as $user) {
                    $userFullName = $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name;
                    if (preg_match("/" . mb_strtolower($filter_full_name) . "/i", mb_strtolower($userFullName))) {
                        $usersTarget[] = $user;
                    }
                }

                if (!count($usersTarget)) {
                    $query->where('id', null);
                } else {
                    foreach ($usersTarget as $key => $userTarget) {
                        if (!$key) {
                            $query->where('id', $userTarget->id);
                        } else {
                            $query->orWhere('id', $userTarget->id);
                        }
                    }
                }
            })
            ->when($order_by, function ($query) use ($order_by, $ordering_rule) {
                $query->orderBy($order_by, $ordering_rule);
            })
            ->paginate($request->per_page ?? 5);

        return UsersResource::collection($users);
    }
    public function create(UserCreateRequest__1 $request)
    {
        $user = User::createNew($request);
        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function update(User $user, Request $request)
    {
        $user->updateUser($request);
        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function my()
    {
        return new UsersDetailResource(Config::get('user'));
    }
    public function userDetail(User $user)
    {
        return new UsersDetailResource($user);
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
        return $user->generateAgencyContract()->output();
    }
    public function addAgencyContract(User $user, Request $request)
    {
        $user->addAgencyContract($request);
        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }

    // public function getUserSales(User $user, Request $request)
    // {
    //     $sales = Sale::whereUserId($user->id)->paginate($request->per_page ?? 5);
    //     return SalesResource::collection($sales);
    // }
    // public function getUserSalesDirect(User $user)
    // {
    //     return new UsersSalesResource($user);
    // }
    // public function getUserSalesBonus(User $user)
    // {
    //     return new UsersSalesResource($user);
    // }

    public function getUserIncome()
    {
        $user          = Config::get('user');
        $configuration = Configuration::first();
        $sales         = $user->sales()->whereStatus(config('constants.sales.statuses.waiting'))->get();
        $total_price   = 0;

        foreach ($sales as $sale) {
            $total_price += ($sale->lead->price / 100) * $sale->percent;
        }

        return [
            'min_payout'  => $configuration->min_payout,
            'total_price' => floor($total_price),
        ];
    }

    public function getUserSales(Request $request)
    {
        $request_params = $request->all();
        $filter_status  = isset($request_params['filter_status']) ? $request_params['filter_status'] : null;
        $sales          = Sale::whereUserId(Config::get('user')->id)
            ->when($filter_status, function ($query) use ($filter_status) {
                $query->whereStatus($filter_status);
            })->paginate($request->per_page ?? 5);
        return SalesResource::collection($sales);
    }
    public function getUserSalesDirects(Request $request)
    {
        //FIXME perform code splitting optimization

        $request_params   = $request->all();
        $filter_date_from = isset($request_params['filter_date_from']) ? Carbon::createFromFormat('d.m.Y', $request->get('filter_date_from'))->startOfDay()->toDateTimeString() : null;
        $filter_date_to   = isset($request_params['filter_date_to']) ? Carbon::createFromFormat('d.m.Y', $request->get('filter_date_to'))->endOfDay()->toDateTimeString() : null;
        $filter_status    = isset($request_params['filter_status']) ? $request_params['filter_status'] : null;
        $filter_lead_name = isset($request_params['filter_lead_name']) ? $request_params['filter_lead_name'] : null;
        $order_by         = isset($request_params['order_by']) ? $request_params['order_by'] : 'created_at';
        $ordering_rule    = isset($request_params['ordering_rule']) ? $request_params['ordering_rule'] : 'desc';

        $sales = Sale::join('leads', 'sales.lead_id', '=', 'leads.id')
            ->where('sales.user_id', Config::get('user')->id)
            ->whereIsDirect(true)
            ->addSelect(DB::raw("*, (leads.price / 100) * cast(sales.percent as int) as sales_price"))
            ->when($filter_date_from, function ($query) use ($filter_date_from) {
                $query->where('sales.created_at', '>=', $filter_date_from);
            })
            ->when($filter_date_to, function ($query) use ($filter_date_to) {
                $query->where('sales.created_at', '<=', $filter_date_to);
            })
            ->when($filter_lead_name, function ($query) use ($filter_lead_name) {
                $query->where('leads.name', 'ILIKE', '%' . $filter_lead_name . '%');
            })
            ->when($filter_status, function ($query) use ($filter_status) {
                $query->whereStatus($filter_status);
            })
            ->when($order_by === 'created_at', function ($query) use ($ordering_rule) {
                $query->orderBy('sales.created_at', $ordering_rule);
            })
            ->when($order_by === 'name', function ($query) use ($ordering_rule) {
                $query->orderBy('leads.name', $ordering_rule);
            })
            ->when($order_by === 'price', function ($query) use ($ordering_rule) {
                $query->orderBy('sales_price', $ordering_rule);
            })
            ->when($order_by === 'status', function ($query) use ($ordering_rule) {
                $query->orderBy('sales.status', $ordering_rule);
            })
            ->paginate($request->per_page ?? 25);

        return SalesResource::collection($sales);
    }
    public function getUserSalesBonusses(Request $request)
    {
        //FIXME perform code splitting optimization

        $request_params      = $request->all();
        $filter_date_from    = isset($request_params['filter_date_from']) ? Carbon::createFromFormat('d.m.Y', $request->get('filter_date_from'))->startOfDay()->toDateTimeString() : null;
        $filter_date_to      = isset($request_params['filter_date_to']) ? Carbon::createFromFormat('d.m.Y', $request->get('filter_date_to'))->endOfDay()->toDateTimeString() : null;
        $filter_level        = isset($request_params['filter_level']) ? $request_params['filter_level'] : null;
        $filter_status       = isset($request_params['filter_status']) ? $request_params['filter_status'] : null;
        $filter_lead_name    = isset($request_params['filter_lead_name']) ? $request_params['filter_lead_name'] : null;
        $filter_partner_name = isset($request_params['filter_partner_name']) ? $request_params['filter_partner_name'] : null;
        $order_by            = isset($request_params['order_by']) ? $request_params['order_by'] : 'created_at';
        $ordering_rule       = isset($request_params['ordering_rule']) ? $request_params['ordering_rule'] : 'desc';
        $users               = DB::table('users');
        $sales               = Sale::join('leads', 'sales.lead_id', '=', 'leads.id')
            ->joinSub($users, 'users', function (JoinClause $join) {
                $join->on('users.id', '=', 'leads.user_id');
            })
            ->where('sales.user_id', Config::get('user')->id)
            ->whereIsDirect(false)
            ->addSelect(DB::raw("*, (leads.price / 100) * cast(sales.percent as int) as sales_price, concat(second_name, ' ', first_name, ' ', third_name) as partner_name"))
            ->when($filter_date_from, function ($query) use ($filter_date_from) {
                $query->where('sales.created_at', '>=', $filter_date_from);
            })
            ->when($filter_date_to, function ($query) use ($filter_date_to) {
                $query->where('sales.created_at', '<=', $filter_date_to);
            })
            ->when($filter_lead_name, function ($query) use ($filter_lead_name) {
                $query->where('leads.name', 'ILIKE', '%' . $filter_lead_name . '%');
            })
            ->when($filter_partner_name, function ($query) use ($filter_partner_name) {
                $sales       = Sale::whereUserId(Config::get('user')->id)->whereIsDirect(false)->get();
                $salesTarget = [];

                foreach ($sales as $sale) {
                    $sales_direct = $sale->lead->sales->where('is_direct', true);

                    foreach ($sales_direct as $sale_direct) {
                        $user         = $sale_direct->user;
                        $userFullName = $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name;

                        if (preg_match("/" . mb_strtolower($filter_partner_name) . "/i", mb_strtolower($userFullName))) {
                            $salesTarget[] = $sale;
                        }
                    }
                }

                if (!count($salesTarget)) {
                    $query->where('sales.id', null);
                } else {
                    foreach ($salesTarget as $key => $saleTarget) {
                        if (!$key) {
                            $query->where('sales.id', $saleTarget->id);
                        } else {
                            $query->orWhere('sales.id', $saleTarget->id);
                        }
                    }
                }
            })
            ->when($filter_level, function ($query) use ($filter_level) {
                $query->whereLevel($filter_level);
            })
            ->when($filter_status, function ($query) use ($filter_status) {
                $query->whereStatus($filter_status);
            })
            ->when($order_by === 'created_at', function ($query) use ($ordering_rule) {
                $query->orderBy('sales.created_at', $ordering_rule);
            })
            ->when($order_by === 'name', function ($query) use ($ordering_rule) {
                $query->orderBy('leads.name', $ordering_rule);
            })
            ->when($order_by === 'price', function ($query) use ($ordering_rule) {
                $query->orderBy('sales_price', $ordering_rule);
            })
            ->when($order_by === 'partner_name', function ($query) use ($ordering_rule) {
                $query->orderBy('partner_name', $ordering_rule);
            })
            ->when($order_by === 'level', function ($query) use ($ordering_rule) {
                $query->orderBy('sales.level', $ordering_rule);
            })
            ->when($order_by === 'status', function ($query) use ($ordering_rule) {
                $query->orderBy('sales.status', $ordering_rule);
            })
            ->paginate($request->per_page ?? 25);

        return SalesBonussesResource::collection($sales);
    }

    public function payoutUserSales()
    {
        $user          = Config::get('user');
        $configuration = Configuration::first();
        $sales         = $user->sales()->whereStatus(config('constants.sales.statuses.waiting'))->get();
        $total_price   = 0;

        foreach ($sales as $sale) {
            $total_price += ($sale->lead->price / 100) * $sale->percent;
        }

        if (!($total_price >= $configuration->min_payout)) {
            return response()->json([
                'status'  => false,
                'message' => 'The minimum total price for payout has not been reached',
            ], Response::HTTP_OK);
        }

        $payout = Payout::create([
            'user_id' => $user->id,
            'price'   => floor($total_price),
            'status'  => config('constants.payouts.statuses.processing'),
        ]);

        foreach ($sales as $sale) {
            $sale->update([
                'status'    => config('constants.sales.statuses.processing'),
                'payout_id' => $payout->id,
            ]);
        }

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function getUserPayouts(Request $request)
    {
        $request_params   = $request->all();
        $filter_date_from = isset($request_params['filter_date_from']) ? Carbon::createFromFormat('d.m.Y', $request->get('filter_date_from'))->startOfDay()->toDateTimeString() : null;
        $filter_date_to   = isset($request_params['filter_date_to']) ? Carbon::createFromFormat('d.m.Y', $request->get('filter_date_to'))->endOfDay()->toDateTimeString() : null;
        $filter_status    = isset($request_params['filter_status']) ? $request_params['filter_status'] : null;
        $order_by         = isset($request_params['order_by']) ? $request_params['order_by'] : 'created_at';
        $ordering_rule    = isset($request_params['ordering_rule']) ? $request_params['ordering_rule'] : 'desc';
        $payouts          = Payout::whereUserId(Config::get('user')->id)
            ->when($filter_date_from, function ($query) use ($filter_date_from) {
                $query->where('created_at', '>=', $filter_date_from);
            })
            ->when($filter_date_to, function ($query) use ($filter_date_to) {
                $query->where('created_at', '<=', $filter_date_to);
            })
            ->when($filter_status, function ($query) use ($filter_status) {
                $query->whereStatus($filter_status);
            })
            ->when($order_by === 'created_at', function ($query) use ($ordering_rule) {
                $query->orderBy('created_at', $ordering_rule);
            })
            ->when($order_by === 'price', function ($query) use ($ordering_rule) {
                $query->orderBy('price', $ordering_rule);
            })
            ->when($order_by === 'status', function ($query) use ($ordering_rule) {
                $query->orderBy('status', $ordering_rule);
            })
            ->paginate($request->per_page ?? 5);

        return PayoutsResource::collection($payouts);
    }
    public function getUserPayout(Payout $payout)
    {
        return new PayoutsResource($payout);
    }
    public function setUserStatusVerification(User $user, UserStatusVerificationSetRequest__1 $request)
    {
        $user->update(['verification_status' => $request->verification_status]);
        $isApproved = $request->verification_status === config('constants.user.verification_statuses.completed');

        if ($isApproved) {
            event(new UserApprovedEvent($user));
        }

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
}
