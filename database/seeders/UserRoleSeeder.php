<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        foreach (UserRole::getValues() as $role) {
            foreach (['api', 'web'] as $guard) {
                Role::findOrCreate($role, $guard);
            }
        }
    }
}
