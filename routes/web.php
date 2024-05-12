<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Layout;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RolController;
use App\Models\Categoria;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#Route::get('/', function () {
#    return view('welcome');
#});
//Route::match(['get', 'post'], '/cargar', [ProductoController::class, 'cargar'])->name('cargar');
Route::get('/',[Layout::class, 'principal'])->name('principal');

Route::get('seleccion-producto/{producto}',[Layout::class, 'SeleccionProducto'])->name('seleccion.Producto');
Route::get('seleccion-categoria/{categoria}',[Layout::class, 'SeleccionCategoria'])->name('seleccion.Categoria');
Route::get('carrito', [Layout::class, 'show_carrito'])->name('show_carrito');

Route::post('cart/{producto}', [Layout::class, 'agregar_carrito'])->name('agregar_carrito');
Route::delete('carrito/delete/{producto}', [Layout::class, 'eliminar_carrito'])->name('eliminar_carrito');
Route::get('edit-producto/{producto}', [Layout::class, 'editar_producto'])->name('editar_producto');
Route::patch('update-producto/{producto}', [Layout::class, 'update_carrito'] )->name('update_carrito');

Route::get('palette', function(){
    return view('index_palette');
});

#Route::get('rol/crear', [RolController::class, 'crearRol'])->name('crearRol');
Route::resource('rol', RolController::class);
Route::resource('producto', ProductoController::class);
#->middleware('auth'); forma de poner un middleware a todo con controlador

Route::resource('categoria', CategoriaController::class)->parameters(['categoria' => 'categoria']);;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('principal');
        #return view('dashboard');
    })->name('dashboard');
});
