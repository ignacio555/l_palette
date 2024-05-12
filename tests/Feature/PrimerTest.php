<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PhpParser\Node\Expr\FuncCall;
use Tests\TestCase;

class PrimerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */

    public function test_carrito()
    {
        $userData = [
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => 'contraseña',
            'password_confirmation' => 'contraseña', // Confirmación de contraseña
        ];

        // Registra al usuario
        $this->post('/register', $userData);

        // Obtiene al usuario recién creado
        $user = User::where('email', 'usuario@example.com')->first();

        // Actualiza el campo de verificación de correo electrónico
        $user->email_verified_at = now();
        $user->save();

        // Inicia sesión manualmente al usuario
        $this->actingAs($user);

        // Realiza una solicitud a la página del carrito
        $response = $this->get(route('show_carrito'));

        // Asegúrate de que la solicitud se redirija a la página del carrito
        #$response->assertRedirect('/carrito');
        //verifica que la pagina contesto correctamente
        $response->assertStatus(200);

        // Asegúrate de que la página del carrito contenga el texto "Carrito"
        $response->assertSee('Carrito');
    }
}
