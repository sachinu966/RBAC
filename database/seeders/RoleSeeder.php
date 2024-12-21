<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles and permissions
        $roles = ['Admin', 'Manager', 'User'];
        $permissions = [
            'manage_users' => 'Manage Users',
            'view_reports' => 'View Reports',
            'edit_profile' => 'Edit Profile'
        ];

        // Create permissions if not already created
        foreach ($permissions as $name => $description) {
            Permission::firstOrCreate(['name' => $name, 'description' => $description]);
        }

        // Create roles and assign permissions
        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            switch ($roleName) {
                case 'Admin':
                    // Assign all permissions to Admin
                    $role->permissions()->sync(Permission::pluck('id')->toArray());
                    break;

                case 'Manager':
                    // Assign specific permissions to Manager
                    $role->permissions()->sync(
                        Permission::whereIn('name', ['view_reports', 'edit_profile'])->pluck('id')->toArray()
                    );
                    break;

                case 'User':
                    // Assign only 'edit_profile' permission to User
                    $role->permissions()->sync(
                        Permission::where('name', 'edit_profile')->pluck('id')->toArray()
                    );
                    break;
            }
        }
    }
}
