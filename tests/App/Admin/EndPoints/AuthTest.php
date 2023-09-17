<?php

use Database\Factories\Client\UserFactory;
use Illuminate\Http\Response;

beforeEach(function () {
   Artisan::call('passport:install');
   $this->admin = UserFactory::new()->admin()->create(['password' => 'password']);
   $this->loginData = [
       'email' => $this->admin->email,
       'password' => 'password',
   ];
});

it('tests admin login', function () {
   $this->post(route('admin.login', $this->loginData))
       ->assertStatus(Response::HTTP_OK);
});
