<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Create roles
         $adminRole = Role::create(['name' => 'admin']);
         $userRole = Role::create(['name' => 'user']);
 
         // Create permissions
         $manageUsersPermission = Permission::create(['name' => 'manage users']);
         $manageRolesPermission = Permission::create(['name' => 'manage roles']);
 
         // Assign permissions to roles
         $adminRole->givePermissionTo($manageUsersPermission, $manageRolesPermission);
 
         // create demo users
         $user = \App\Models\User::factory()->create([
             'name' => 'Anthony Johnson',
             'email' => 'test@example.com',
             'password' => Hash::make('password'),
         ]);
         $user->assignRole('user');
 
         $user = \App\Models\User::factory()->create([
             'name' => 'Andrew Tate',
             'email' => 'topg@example.com',
             'password' => Hash::make('password')
         ]);
         $user->assignRole('user');
 
         $user = \App\Models\User::factory()->create([
             'name' => 'Sarah Apple',
             'email' => 'testuser@example.com',
             'password' => Hash::make('password')
         ]);
         $user->assignRole('user');
 
         $user = \App\Models\User::factory()->create([
             'name' => 'Admin User',
             'email' => 'admin@example.com',
             'password' => Hash::make('password')
         ]);
         $user->assignRole('admin');
    }
}
