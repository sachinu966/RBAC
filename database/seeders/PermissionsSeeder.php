<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'manage_users', 'description' => 'Can manage users']);
        Permission::create(['name' => 'view_reports', 'description' => 'Can view reports']);
        Permission::create(['name' => 'edit_profile', 'description' => 'Can edit profile']);
    }
}
