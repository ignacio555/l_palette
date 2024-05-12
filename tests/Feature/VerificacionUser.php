<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerificacionUser extends TestCase
{
    /**
     * A basic feature test example.
     */


         use DatabaseTransactions;
     
         public function test_user_can_register()
         {
             $userData = [
                 'name' => 'Nombre de Usuario',
                 'email' => 'usuario@example.com',
                 'password' => 'contraseña',
                 'password_confirmation' => 'contraseña', // Confirmación de contraseña
             ];
     
             // Hacer una solicitud POST a la ruta de registro con los datos del usuario
             $response = $this->post('/register', $userData);
             $response = $this->get(route('show_carrito'));
             $response->assertRedirect('/carrito');
     
             // Asegurar que la solicitud de registro fue exitosa y que el usuario está autenticado
             $response->assertRedirect('/dashboard'); // Asegurar que la redirección es correcta después del registro
             $this->assertAuthenticated(); // Verificar que un usuario está autenticado globalmente en la aplicación
     
             // Verificar que el usuario específico está autenticado
             $this->assertAuthenticatedAs(User::where('email', 'usuario@example.com')->first());
     
             // Opcionalmente, puedes verificar que el usuario se haya creado correctamente en la base de datos
             $this->assertDatabaseHas('users', ['email' => 'usuario@example.com']);
         }
     
}
