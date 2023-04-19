<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_role_id' => '',
            'first_name' => 'adminFirstName',
            'second_name' => 'adminSecondName',
            'third_name' => 'adminThirdName',
            'gender' => 'male',
            'birthday' => Carbon::now(),
            'email' => '',
            'password' => '',
            'token' => '',
            'phone' => '',
            'invite_code' => '',
            'individual_code' => '',
        ]);
    }
}
