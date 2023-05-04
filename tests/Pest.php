<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Passport\Passport;

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
