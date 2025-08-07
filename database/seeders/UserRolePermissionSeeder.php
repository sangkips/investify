<?php

namespace Database\Seeders;

use App\Models\User;
use Doctrine\DBAL\Schema\View;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        Permission::firstOrCreate(['name' => 'view-role']);
        Permission::firstOrCreate(['name' => 'create-role']);
        Permission::firstOrCreate(['name' => 'update-role']);
        Permission::firstOrCreate(['name' => 'delete-role']);

        Permission::firstOrCreate(['name' => 'view-permission']);
        Permission::firstOrCreate(['name' => 'create-permission']);
        Permission::firstOrCreate(['name' => 'update-permission']);
        Permission::firstOrCreate(['name' => 'delete-permission']);

        Permission::firstOrCreate(['name' => 'view-user']);
        Permission::firstOrCreate(['name' => 'create-user']);
        Permission::firstOrCreate(['name' => 'update-user']);
        Permission::firstOrCreate(['name' => 'delete-user']);

        $ViewProduct = Permission::firstOrCreate(['name' => 'view-product']);
        $CreateProduct = Permission::firstOrCreate(['name' => 'create-product']);
        $UpdateProduct = Permission::firstOrCreate(['name' => 'update-product']);
        $DeleteProduct = Permission::firstOrCreate(['name' => 'delete-product']);

        Permission::firstOrCreate(['name' => 'view-order']);
        Permission::firstOrCreate(['name' => 'create-order']);
        Permission::firstOrCreate(['name' => 'update-order']);
        Permission::firstOrCreate(['name' => 'delete-order']);

        Permission::firstOrCreate(['name' => 'view-purchase']);
        Permission::firstOrCreate(['name' => 'create-purchase']);
        Permission::firstOrCreate(['name' => 'update-purchase']);
        Permission::firstOrCreate(['name' => 'delete-purchase']);

        Permission::firstOrCreate(['name' => 'view-quatation']);
        Permission::firstOrCreate(['name' => 'create-quatation']);
        Permission::firstOrCreate(['name' => 'update-quatation']);
        Permission::firstOrCreate(['name' => 'delete-quatation']);

        Permission::firstOrCreate(['name' => 'view-suppliers']);
        Permission::firstOrCreate(['name' => 'create-suppliers']);
        Permission::firstOrCreate(['name' => 'update-suppliers']);
        Permission::firstOrCreate(['name' => 'delete-suppliers']);

        Permission::firstOrCreate(['name' => 'view-customer']);
        Permission::firstOrCreate(['name' => 'create-customer']);
        Permission::firstOrCreate(['name' => 'update-customer']);
        Permission::firstOrCreate(['name' => 'delete-customer']);

        Permission::firstOrCreate(['name' => 'view-category']);
        Permission::firstOrCreate(['name' => 'create-category']);
        Permission::firstOrCreate(['name' => 'update-category']);
        Permission::firstOrCreate(['name' => 'delete-category']);

        Permission::firstOrCreate(['name' => 'view-unit']);
        Permission::firstOrCreate(['name' => 'create-unit']);
        Permission::firstOrCreate(['name' => 'update-unit']);
        Permission::firstOrCreate(['name' => 'delete-unit']);

        // Simplified role-based permissions
        Permission::firstOrCreate(['name' => 'view-dashboard']);
        Permission::firstOrCreate(['name' => 'manage-products']);
        Permission::firstOrCreate(['name' => 'manage-orders']);
        Permission::firstOrCreate(['name' => 'manage-purchases']);
        Permission::firstOrCreate(['name' => 'manage-quotations']);
        Permission::firstOrCreate(['name' => 'manage-customers']);
        Permission::firstOrCreate(['name' => 'manage-suppliers']);
        Permission::firstOrCreate(['name' => 'manage-categories']);
        Permission::firstOrCreate(['name' => 'manage-units']);
        Permission::firstOrCreate(['name' => 'view-reports']);
        Permission::firstOrCreate(['name' => 'manage-users']);




        // Create Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        // Create simplified roles
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $salesRole = Role::firstOrCreate(['name' => 'sales']);
        $inventoryRole = Role::firstOrCreate(['name' => 'inventory']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo(['create-role', 'view-role', 'update-role']);
        $adminRole->givePermissionTo(['create-permission', 'view-permission']);
        $adminRole->givePermissionTo(['create-user', 'view-user', 'update-user']);
        $adminRole->givePermissionTo([$CreateProduct, $ViewProduct, $UpdateProduct, $DeleteProduct]);
        $adminRole->givePermissionTo(['create-order', 'view-order', 'update-order']);

        $staffRole->givePermissionTo(['create-order', 'view-order']);
        $staffRole->givePermissionTo(['create-purchase', 'view-purchase']);
        $staffRole->givePermissionTo(['create-quatation', 'view-quatation']);
        $staffRole->givePermissionTo(['create-suppliers', 'view-suppliers']);
        $staffRole->givePermissionTo(['create-customer', 'view-customer', 'update-customer']);
        $staffRole->givePermissionTo([$CreateProduct, $ViewProduct]);
        $staffRole->givePermissionTo(['create-unit', 'view-unit', 'update-unit']);
        $staffRole->givePermissionTo(['create-category', 'view-category', 'update-category']);

        // Assign simplified permissions to new roles
        $managerRole->givePermissionTo([
            'view-dashboard',
            'manage-products',
            'manage-orders',
            'manage-purchases',
            'manage-quotations',
            'manage-customers',
            'manage-suppliers',
            'view-reports',
        ]);

        $salesRole->givePermissionTo([
            'view-dashboard',
            'manage-orders',
            'manage-quotations',
            'manage-customers',
        ]);

        $inventoryRole->givePermissionTo([
            'view-dashboard',
            'manage-products',
            'manage-purchases',
            'manage-suppliers',
            'manage-categories',
            'manage-units',
        ]);

        $viewerRole->givePermissionTo([
            'view-dashboard',
            'view-reports',
        ]);

        # Sync permissions to roles

        $superAdminRole->syncPermissions($allPermissionNames);

        $adminRole->syncPermissions(['create-role', 'view-role', 'update-role']);
        $adminRole->syncPermissions(['create-permission', 'view-permission']);
        $adminRole->syncPermissions(['create-user', 'view-user', 'update-user']);
        $adminRole->syncPermissions(['create-product', 'view-product', 'update-product']);
        $adminRole->syncPermissions(['create-order', 'view-order', 'update-order']);

        $staffRole->syncPermissions(['create-order', 'view-order']);
        $staffRole->syncPermissions(['create-purchase', 'view-purchase']);
        $staffRole->syncPermissions(['create-quatation', 'view-quatation']);
        $staffRole->syncPermissions(['create-suppliers', 'view-suppliers']);
        $staffRole->syncPermissions(['create-customer', 'view-customer', 'update-customer']);
        $staffRole->syncPermissions(['create-product', 'view-product']);
        $staffRole->syncPermissions(['create-unit', 'view-unit', 'update-unit']);
        $staffRole->syncPermissions(['create-category', 'view-category', 'update-category']);


        // Let's Create User and assign Role to it.

        $superAdminUser = User::firstOrCreate([
            'email' => 'sangkips19@gmail.com',
        ], [
            'name' => 'Sang',
            'email' => 'sangkips19@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Sang@123%'),
            'uuid' => Str::uuid(),
        ]);

        $superAdminUser->assignRole($superAdminRole);


        $adminUser = User::firstOrCreate([
            'email' => 'nextgentips01@gmail.com'
        ], [
            'name' => 'James',
            'email' => 'nextgentips01@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Sang@123%'),
            'uuid' => Str::uuid(),
        ]);

        $adminUser->assignRole($adminRole);


        $staffUser = User::firstOrCreate([
            'email' => 'sangkipkoech@gmail.com',
        ], [
            'name' => 'Maina',
            'email' => 'sangkipkoech@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Sang@123%'),
            'uuid' => Str::uuid(),
        ]);

        $staffUser->assignRole($staffRole);
    }
}
