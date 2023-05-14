<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Domain\Client\Enums\RoleEnum;
use Domain\Client\Enums\PermissionEnum;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Insert roles
        collect(RoleEnum::getValues())->each(function ($role) {
            Role::query()->firstOrCreate(['name' => $role, 'guard_name' => 'api']);
        });
        // Insert permissions
        collect(PermissionEnum::getValues())->each(function ($permission) {
            Permission::query()->firstOrCreate(['name' => $permission, 'guard_name' => 'api']);
        });
    }
}
