<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('login screen can be rendered', function () {
    $response = $this->get('/user/login');
    $response->assertStatus(200);
});

test('user can login with valid credentials', function () {
    $user = User::factory()->create([
        'password' => bcrypt($password = 'password123'),
    ]);

    $response = $this->post('/user/login', [
        'email' => $user->email,
        'password' => $password,
    ]);

    $response->assertRedirect('/user/dashboard');
    $this->assertAuthenticatedAs($user);
});

test('user cannot login with invalid credentials', function () {
    $response = $this->post('/user/login', [
        'email' => 'nonexistent@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors();
    $this->assertGuest();
});

test('user can register', function () {
    $response = $this->post('/user/register', [
        'name' => 'Test User',
        'email' => 'testuser@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect('/user/dashboard');
    $this->assertDatabaseHas('users', [
        'email' => 'testuser@example.com',
    ]);
});

test('user can logout', function () {
    $this->actingAs($this->user);

    $response = $this->post('/user/logout');

    $response->assertRedirect('/');
    $this->assertGuest();
});
