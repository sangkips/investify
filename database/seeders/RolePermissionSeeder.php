<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = [
            'view-dashboard',
            'manage-products',
            'manage-orders',
            'manage-purchases',
            'manage-quotations',
            'manage-customers',
            'manage-suppliers',
            'manage-categories',
            'manage-units',
            'view-reports',
            'manage-users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $managerRole = Role::firstOrCreate(['name' => 'manager']);
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

        $salesRole = Role::firstOrCreate(['name' => 'sales']);
        $salesRole->givePermissionTo([
            'view-dashboard',
            'manage-orders',
            'manage-quotations',
            'manage-customers',
        ]);

        $inventoryRole = Role::firstOrCreate(['name' => 'inventory']);
        $inventoryRole->givePermissionTo([
            'view-dashboard',
            'manage-products',
            'manage-purchases',
            'manage-suppliers',
            'manage-categories',
            'manage-units',
        ]);

        $viewerRole = Role::firstOrCreate(['name' => 'viewer']);
        $viewerRole->givePermissionTo([
            'view-dashboard',
            'view-reports',
        ]);
    }
}