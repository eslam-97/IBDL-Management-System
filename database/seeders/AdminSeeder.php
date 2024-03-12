<?php

namespace Database\Seeders;

use App\Helpers\XorHelper;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => XorHelper::xor('admin'),
            'email'=> XorHelper::xor('admin@gmail.com'),
            'phone'=> XorHelper::xor(phone('01004753538', 'eg')),
            'email_verified_at'=> now(),
            'password' =>XorHelper::xor('123456'),
        ]);

        $user->assignRole('admin');
    }
}
