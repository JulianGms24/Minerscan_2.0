<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que la página de Login sea accesible.
     */
    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Verifica que un usuario pueda registrarse.
     */
    public function test_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Usuario Prueba',
            'email' => 'usuario.prueba@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'email' => 'usuario.prueba@test.com',
            'name' => 'Usuario Prueba',
        ]);
    }

    /**
     * Verifica que un usuario pueda iniciar sesión.
     */
    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'login@test.com',
            'password' => 'password123',
        ]);

        $response = $this->post('/login', [
            'email' => 'login@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');

        $this->assertAuthenticatedAs($user);
    }

    /**
     * Verifica que un usuario no autenticado
     * no pueda acceder al Dashboard.
     */
    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * Verifica que un usuario autenticado
     * pueda acceder al Dashboard.
     */
    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    /**
     * Verifica que un usuario pueda cerrar sesión.
     */
    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/login');

        $this->assertGuest();
    }
}