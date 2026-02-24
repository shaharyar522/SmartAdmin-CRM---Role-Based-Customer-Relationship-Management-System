<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Manager User',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'Staff User',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'staff',
        ]);
    }
}
