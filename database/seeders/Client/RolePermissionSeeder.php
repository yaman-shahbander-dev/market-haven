<?php
namespace Database\Seeders\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Domain\Client\Enums\RoleEnum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enumRolesPermissions = RoleEnum::getRolesPermissions();
        $matchedRoles = Role::query()->whereIn('name', array_keys($enumRolesPermissions))->get();
        $matchedPermissions = Permission::query()->whereIn('name', Arr::flatten($enumRolesPermissions))->get();
        foreach ($matchedRoles as $matchedRole) {
            $matchedRole->permissions()->syncWithoutDetaching(
                $matchedPermissions->whereIn('name', $enumRolesPermissions[$matchedRole->name])
                    ->pluck('id')->toArray()
            );
        }
    }
}
