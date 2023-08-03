<?php

namespace Database\Seeders\Client;

use Domain\Client\Enums\RoleEnum;
use Domain\Client\Models\User;
use Illuminate\Database\Seeder;
use Domain\Client\Enums\UserTypes;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = app(User::class)->query()->get();
        $userPermissions = RoleEnum::getRolesPermissions()[UserTypes::USER->value];
        $permissions = Permission::query()->whereIn('name', $userPermissions)->select(['id'])->get();
        $data = [];
        foreach ($users as $user) {
            foreach ($permissions as $permission) {
                $entry = [
                    'permission_id' => $permission->id,
                    'model_id' => $user->id,
                    'model_type' => UserTypes::USER->value,
                ];
                // Check if the entry already exists in the table
                if (!DB::table('model_has_permissions')->where($entry)->exists()) {
                    $data[] = $entry;
                }
            }
        }

        DB::table('model_has_permissions')->insert($data);
    }
}
