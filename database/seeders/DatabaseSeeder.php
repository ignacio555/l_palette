<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

                // Crear 10 categorías
                Categoria::factory(10)->create()->each(function ($categoria) {
                    // Crear 20 productos para cada categoría
                    $productos = Producto::factory(8)->create();
                    $categoria->productos()->saveMany($productos);
                });
        
    }
}
