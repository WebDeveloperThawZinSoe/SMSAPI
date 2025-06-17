<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
           $this->call(RoleSeeder::class);

    $admin = User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'api_key' => Str::random(32),
        'password' => bcrypt('password'), // Use secure password in production
    ]);

    $admin->assignRole('admin');
    }
}
