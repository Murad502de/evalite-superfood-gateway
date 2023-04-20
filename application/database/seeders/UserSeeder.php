<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Traits\GenerateUserTokenTrait;
use App\Traits\PasswordEncryptTrait;
use App\Traits\SharedGendersTrait;
use App\Traits\SharedRolesTrait;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use SharedGendersTrait, SharedRolesTrait, PasswordEncryptTrait, GenerateUserTokenTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id'    => Role::whereCode(self::$USER_ROLE_ADMIN)->first()->id,
            'first_name'      => 'adminFirstName',
            'second_name'     => 'adminSecondName',
            'third_name'      => 'adminThirdName',
            'gender'          => self::$GENDER_MALE,
            'birthday'        => Carbon::now(),
            'email'           => config('app.admin_email'),
            'password'        => self::passwordEncrypt(config('app.admin_password')),
            'token'           => self::generateUserToken(),
            'phone'           => '',
            'invite_code'     => 'ADMIN_INVITE_CODE',
            'individual_code' => 'ADMIN_INDIVIDUAL_CODE',
            'promo_code'      => '',
        ]);
    }
}
