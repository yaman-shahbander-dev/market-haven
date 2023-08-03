<?php

namespace Domain\Client\Actions\User;

use Domain\Client\Enums\RoleEnum;
use Domain\Client\Enums\UserTypes;
use Domain\Client\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class AssignPermissionsToUserAction
{
    use AsAction;

    public function handle(User $user): bool
    {
        $userPermissions = RoleEnum::getRolesPermissions()[UserTypes::USER->value];
        $permissions = Permission::query()->whereIn('name', $userPermissions)->select(['id'])->get();
        $data = [];
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
        return DB::table('model_has_permissions')->insert($data);
    }
}
