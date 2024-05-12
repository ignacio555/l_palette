<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SegundoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_agregarProducto()
    {
        //crea el usuario
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
        $datos = ['cantidad'=>'2'];

        //hace una peticion post
        $response = $this->post('cart/1',$datos);
        //veirica la redireccion
        $response->assertStatus(302); // Redirección
        $response->assertRedirect('/'); // Verifica la redirección esperada
        //verifica que los datos esten en la base de datos.
        $this->assertDatabaseHas('producto_user', [
            'user_id' => auth()->user()->id,
            'cantidad'=>'2'
        ]);
    }
}
