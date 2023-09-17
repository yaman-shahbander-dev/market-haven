<?php

namespace Database\Seeders\Client;

use Database\Factories\Client\UserFactory;
use Domain\Client\Enums\UserGenders;
use Domain\Client\Enums\UserScopes;
use Domain\Client\Enums\UserTypes;
use Domain\Client\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::query()->firstOrCreate([
            'email' => 'admin@project.com',
        ], [
            'name' => 'Admin',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'gender' => UserGenders::getRandomValue(),
            'scope' => UserScopes::ADMIN->value,
            'type' => UserTypes::ADMIN->value,
            'email_verified_at' => now(),
            'password' => 'password',
            'banned_at' => null,
            'remember_token' => Str::random(10),
        ]);

        UserFactory::new()->count(10)->create();
    }
}
