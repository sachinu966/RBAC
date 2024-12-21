<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
        ]);

        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole) {
            $admin->roles()->attach($adminRole->id);
        } else {
            $this->command->error("Admin role not found.");
        }
    }
}
