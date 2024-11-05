<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage users', // admin
            'manage category', // admin
            'manage bedrooms', // admin & staff
            'make confirmation', // admin & staff
            'cashier', // admin & staff
            'view bedrooms', // order
            'make reservation', // order
            'make account', // order
            'view transaksi', // order
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        $user = User::create([
            'code_user' => 'USR0001',
            'first_name' => 'superadmin',
            'last_name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'no_phone' => '08578389383',
            'address' => 'kalongan'
        ]);

        $user->assignRole($superAdminRole);

        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $adminPermission = [
            'manage category', //admin
            'manage users', // admin
            'manage bedrooms', // admin & staff
            'make confirmation', // admin & staff
            'cashier', // admin & staff
        ];

        $userAdmin = User::create([
            'code_user' => 'USR0002',
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'no_phone' => '08578389382',
            'address' => 'kalongan'
        ]);

        $userAdmin->assignRole($adminRole);
        $adminRole->syncPermissions($adminPermission);

        $staffRole = Role::firstOrCreate([
            'name' => 'staff'
        ]);

        $staffPermission = [
            'manage bedrooms', // admin & staff
            'make confirmation', // admin & staff
            'cashier', // admin & staff
        ];

        $userStaf = User::create([
            'code_user' => 'USR0003',
            'first_name' => 'staff',
            'last_name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('password'),
            'no_phone' => '08578389381',
            'address' => 'kalongan'
        ]);

        $userStaf->assignRole($staffRole);
        $staffRole->syncPermissions($staffPermission);

        $orderRole = Role::firstOrCreate([
            'name' => 'order'
        ]);

        $orderPermission = [
            'view bedrooms', // order
            'make reservation', // order
            'make account', // order
            'view transaksi', // order
        ];

        $orderRole->syncPermissions($orderPermission);
    }
}
