<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the admin user for the application.
     */
    public function run(): void
    {
        // Check if admin already exists
        $adminExists = User::where('email', 'admin@herbal.com')->exists();

        if (!$adminExists) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@herbal.com',
                'password' => Hash::make('password'), // CHANGE THIS IN PRODUCTION!
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@herbal.com');
            $this->command->info('Password: password');
            $this->command->warn('⚠️  IMPORTANT: Change the default password immediately!');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
