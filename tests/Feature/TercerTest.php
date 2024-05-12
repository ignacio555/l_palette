<?php

namespace Tests\Feature;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Attributes\Validate;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Tests\TestCase;

class TercerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_datosIncorrectos()
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
    
        // se crea el arreglo tipo request que se almacenara
        $datos = ['cantidad' => '12'];
    
       
        $response = $this->post('cart/1', $datos);
    
        // Verifica que la respuesta tenga un código de estado 302 (Redirección)
        $response->assertStatus(302);
        
    
        // Verifica que la sesión tenga los errores de validación esperados
        $response->assertSessionHasErrors([
            'cantidad' => 'The cantidad field must not be greater than 10.',
        ]);

    }
}
