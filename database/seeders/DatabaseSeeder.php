<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserRoleSeeder::class,    
            AdminSeeder::class,    
            LanguageSeeder::class      
        ]);

        Artisan::call('passport:client', [
            '--personal' => true,
            '--name' => 'frontend_access',
        ]);
    }
}