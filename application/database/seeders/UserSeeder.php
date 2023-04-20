<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use App\Traits\GenerateUserTokenTrait;
use App\Traits\PasswordEncryptTrait;
use App\Traits\SharedGendersTrait;
use App\Traits\SharedUserRolesTrait;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use SharedGendersTrait, SharedUserRolesTrait, PasswordEncryptTrait, GenerateUserTokenTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_role_id'    => UserRole::whereCode(self::$USER_ROLE_ADMIN)->first()->id,
            'first_name'      => 'adminFirstName',
            'second_name'     => 'adminSecondName',
            'third_name'      => 'adminThirdName',
            'gender'          => self::$GENDER_MALE,
            'birthday'        => Carbon::now(),
            'email'           => config('app.admin_email'),
            'password'        => self::passwordEncrypt(config('app.admin_password')),
            'token'           => self::generateUserToken(),
            'phone'           => '',
            'invite_code'     => '',
            'individual_code' => '',
        ]);
    }
}
