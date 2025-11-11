<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the table first
        DB::table('users')->delete();

        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => null,
        ]);

        // Create regular user
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user123'),
            'remember_token' => null,
        ]);

        // Create your specific user
        User::create([
            'name' => 'IUST User',
            'email' => 'edu@iust.sy',
            'email_verified_at' => now(),
            'password' => Hash::make('EDU@iust.sy'),
            'remember_token' => null,
        ]);

        $this->command->info('Users created successfully!');
        $this->command->info('=== Login Credentials ===');
        $this->command->info('Admin: admin@example.com / admin123');
        $this->command->info('User: user@example.com / user123');
        $this->command->info('IUST: edu@iust.sy / EDU@iust.sy');
    }
}