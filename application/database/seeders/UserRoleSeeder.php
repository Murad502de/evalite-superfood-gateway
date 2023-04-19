<?php

namespace Database\Seeders;

use App\Models\UserRole;
use App\Traits\SharedUserRolesTrait;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    use SharedUserRolesTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::create([
            'code'       => self::$USER_ROLE_ADMIN,
            'name'       => 'администратор',
            'is_default' => true,
        ]);
    }
}
