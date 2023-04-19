<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use App\Traits\SharedGendersTrait;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Traits\SharedUserRolesTrait;

class UserSeeder extends Seeder
{
    use SharedGendersTrait, SharedUserRolesTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_role_id'    => UserRole::whereCode(self::$USER_ROLE_ADMIN),
            'first_name'      => 'adminFirstName',
            'second_name'     => 'adminSecondName',
            'third_name'      => 'adminThirdName',
            'gender'          => self::$GENDER_MALE,
            'birthday'        => Carbon::now(),
            'email'           => '',
            'password'        => '',
            'token'           => '',
            'phone'           => '',
            'invite_code'     => '',
            'individual_code' => '',
        ]);
    }
}
