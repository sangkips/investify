<?php

namespace Database\Seeders;

use App\Models\User;
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
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'update product']);
        Permission::create(['name' => 'delete product']);

        Permission::create(['name' => 'view order']);
        Permission::create(['name' => 'create order']);
        Permission::create(['name' => 'update order']);
        Permission::create(['name' => 'delete order']);

        Permission::create(['name' => 'view purchase']);
        Permission::create(['name' => 'create purchase']);
        Permission::create(['name' => 'update purchase']);
        Permission::create(['name' => 'delete purchase']);

        Permission::create(['name' => 'view quatation']);
        Permission::create(['name' => 'create quatation']);
        Permission::create(['name' => 'update quatation']);
        Permission::create(['name' => 'delete quatation']);

        Permission::create(['name' => 'view suppliers']);
        Permission::create(['name' => 'create suppliers']);
        Permission::create(['name' => 'update suppliers']);
        Permission::create(['name' => 'delete suppliers']);

        Permission::create(['name' => 'view customer']);
        Permission::create(['name' => 'create customer']);
        Permission::create(['name' => 'update customer']);
        Permission::create(['name' => 'delete customer']);

        Permission::create(['name' => 'view category']);
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'update category']);
        Permission::create(['name' => 'delete category']);

        Permission::create(['name' => 'view unit']);
        Permission::create(['name' => 'create unit']);
        Permission::create(['name' => 'update unit']);
        Permission::create(['name' => 'delete unit']);




        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo(['create role', 'view role', 'update role']);
        $adminRole->givePermissionTo(['create permission', 'view permission']);
        $adminRole->givePermissionTo(['create user', 'view user', 'update user']);
        $adminRole->givePermissionTo(['create product', 'view product', 'update product']);
        $adminRole->givePermissionTo(['create order', 'view order', 'update order']);

        $staffRole->givePermissionTo(['create order', 'view order']);
        $staffRole->givePermissionTo(['create purchase', 'view purchase']);
        $staffRole->givePermissionTo(['create quatation', 'view quatation']);
        $staffRole->givePermissionTo(['create suppliers', 'view suppliers']);
        $staffRole->givePermissionTo(['create customer', 'view customer', 'update customer']);
        $staffRole->givePermissionTo(['create product', 'view product']);
        $staffRole->givePermissionTo(['create unit', 'view unit', 'update unit']);
        $staffRole->givePermissionTo(['create category', 'view category', 'update category']);


        // Let's Create User and assign Role to it.

        $superAdminUser = User::firstOrCreate([
            'email' => 'sangkips19@gmail.com',
        ], [
            'name' => 'Super Admin',
            'email' => 'sangkips19@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Sang@123%'),
            'uuid' => Str::uuid(),
        ]);

        $superAdminUser->assignRole($superAdminRole);


        $adminUser = User::firstOrCreate([
            'email' => 'nextgentips01@gmail.com'
        ], [
            'name' => 'Admin',
            'email' => 'nextgentips01@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Sang@123%'),
            'uuid' => Str::uuid(),
        ]);

        $adminUser->assignRole($adminRole);


        $staffUser = User::firstOrCreate([
            'email' => 'sangkipkoech@gmail.com',
        ], [
            'name' => 'Staff',
            'email' => 'sangkipkoech@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Sang@123%'),
            'uuid' => Str::uuid(),
        ]);

        $staffUser->assignRole($staffRole);
    }
}
