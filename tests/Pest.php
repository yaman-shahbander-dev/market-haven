<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Permission;
use Domain\Client\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;

uses(
    TestCase::class,
    CreatesApplication::class,
    RefreshDatabase::class,
)->in('App', 'Domain');

function actingAs(Authenticatable $user, array $scopes = ['user'])
{
    Passport::actingAs($user, $scopes);
    return test();
}

function givePermission(User $user, string $permission = null)
{
    if (!empty($permission)) {
        if (!(Permission::where('name', $permission)->exists())) {
            Permission::create(['name' => $permission]);
        }
        $user->givePermissionTo($permission);
    }
    return test();
}

function assignRole(User $user, string $role = null)
{
    if (!empty($role)) {
        Role::create(['name' => $role]);
        $user->assignRole($role);
    }
    return test();
}

function actWithPermission(Model $user, string $permission = null, array $scopes = ['user'])
{
    if ($user instanceof User) {
        actingAs($user, $scopes)?->givePermission($user, $permission);
    }
    return test();
}

function actWithRole(Model $user, string $role = null, array $scopes = ['user'])
{
    if ($user instanceof User) {
        actingAs($user, $scopes)?->assignRole($user, $role);
    }
    return test();
}
