<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Traits\GenerateUserTokenTrait;
use App\Traits\PasswordEncryptTrait;
use App\Traits\SharedEmploymentTypesTrait;
use App\Traits\SharedGendersTrait;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use SharedGendersTrait,
    PasswordEncryptTrait,
    GenerateUserTokenTrait,
        SharedEmploymentTypesTrait;

    public function run(): void
    {
        User::create([
            'role_id'             => Role::whereCode(Role::$ROLE_CODE_ADMIN)->first()->id,
            'first_name'          => 'adminFirstName',
            'second_name'         => 'adminSecondName',
            'third_name'          => 'adminThirdName',
            'gender'              => self::$GENDER_MALE,
            'birthday'            => Carbon::now(),
            'employment_type'     => self::$INDIVIDUAL_ENTREPRENEUR,
            'email'               => config('app.admin_email'),
            'password'            => self::passwordEncrypt(config('app.admin_password')),
            'token'               => self::generateUserToken(),
            'phone'               => '',
            'invite_code'         => 'ADMIN_INVITE_CODE',
            'individual_code'     => 'ADMIN_INDIVIDUAL_CODE',
            'promo_code'          => '',
            'verification_status' => config('constants.user.verification_statuses.completed'),
        ]);
    }
}
