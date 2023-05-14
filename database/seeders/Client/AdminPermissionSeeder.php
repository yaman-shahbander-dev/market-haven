<?php

namespace Database\Seeders\Client;

use Domain\Client\Enums\UserTypes;
use Domain\Client\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('model_has_permissions')->truncate();
        $user = app(User::class)->query()->admin()->first();
        $permissions = Permission::query()->select(['id'])->get();
        $data = [];
        foreach ($permissions as $permission) {
            $data[] = [
                'permission_id' => $permission->id,
                'model_id' => $user->id,
                'model_type' => UserTypes::USER->value,
            ];
        }
        DB::table('model_has_permissions')->insert($data);
    }
}
