<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Reward;
use App\Models\Order;
use App\Models\Message;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'César Sánchez',
            'email' => 'cesar@unach.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'profile_photo_url' => fake()->imageUrl(),
            'role' => 'admin',
            'points' => 1000000,
            'spent_points' => 0,
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'name' => 'Jovanna Guadalupe',
            'email' => 'jovanna@unach.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'profile_photo_url' => fake()->imageUrl(),
            'role' => 'student',
            'points' => 1000000,
            'spent_points' => 0,
            'remember_token' => Str::random(10),
        ]);

        User::factory(15)->create();
        Reward::factory(8)->create();
        Order::factory(20)->create();
        Message::factory(50)->create();
    }
}
