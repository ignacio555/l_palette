<?php

namespace Tests\Feature;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CuartoTest extends TestCase
{
    use InteractsWithDatabase;
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_eliminar()
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

        //se crea el registro
        $datos = ['cantidad'=>'2'];
        $response = $this->post('cart/1',$datos);
        
         //verifica que los datos esten en la base de datos.
        $this->assertDatabaseHas('producto_user', [
                'user_id' => auth()->user()->id,
                'cantidad'=>'2'
        ]);
        //se asignan los datos que se eliminaran
        $id_producto =1;
        $response = $this->delete("carrito/delete/{$id_producto}");
        //se verifica si existe el producto en la tabla, se usa esta funcion ya que por el mommento no funciona
        //assertDeleted
        $this->assertDatabaseMissing('producto_user',['producto_id'=>$id_producto, 'user_id' => auth()->user()->id,]);

        // Verifica que la respuesta sea una redirección
        $response->assertStatus(302);
    }
}
