<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Traits\SharedRolesTrait;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    use SharedRolesTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'code'       => self::$USER_ROLE_ADMIN,
            'name'       => 'администратор',
            'is_default' => false,
        ]);
        Role::create([
            'code'       => self::$USER_ROLE_REFERRAL,
            'name'       => 'реферал',
            'is_default' => true,
        ]);
    }
}
