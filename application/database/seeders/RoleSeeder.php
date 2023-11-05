<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'code'       => Role::$ROLE_CODE_ADMIN,
            'name'       => 'администратор',
            'is_default' => false,
        ]);
        Role::create([
            'code'       => Role::$ROLE_CODE_PARTNER,
            'name'       => 'партнер',
            'is_default' => true,
        ]);
    }
}
