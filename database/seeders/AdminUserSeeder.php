<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            User::create([
                'name' => 'Admin User',
                'email' => 'mhasi@g.com',
                'mobile' => '1234567890',
                'password' => Hash::make('admin@123#'),
                'role' => RoleEnum::ADMIN->value,
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
