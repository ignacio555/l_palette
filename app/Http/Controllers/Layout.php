<?php

namespace App\Http\Controllers;

use App\Mail\carrito;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;

class Layout extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['agregar_carrito', 'show_carrito', 'editar_producto', 'eliminar_carrito']);

        //$this->authorizeResource(Comentario::class, 'comentario');
    }

    public function principal()
    {
        $categorias = Categoria::take(4)->with('productos')->get();
        $nav_categoria = Categoria::where('id','>', $categorias->last()->id)->orderBy('id')->get();
        #$productos = $categorias[1]->productos()->take(2)->get();
        return view('principal.index_palette', compact('categorias', 'nav_categoria'));
    }

    public function SeleccionProducto(Producto $producto)
    {
        #$categorias = Categoria::with('productos')->take(4)->get();
        #$nav_categoria = Categoria::where('id', '>', $categorias->last()->id)->with('productos')->orderBy('id')->get();
        $categorias = Categoria::take(4)->get();
        $nav_categoria = Categoria::where('id','>', $categorias->last()->id)->orderBy('id')->get();
        #$id_user = auth()->id;
        return view('principal.producto', compact('producto','categorias','nav_categoria'));
    }

    public function SeleccionCategoria(Categoria $categoria)
    {
        $categorias = Categoria::take(4)->get();
        $nav_categoria = Categoria::where('id','>', $categorias->last()->id)->orderBy('id')->get();
        $productos = $categoria->productos()->with('categorias')->get();
        #$productos = $categoria->productos()->get();
        #dd($categoria);
        return view('principal.categoria', compact('categoria','productos','categorias','nav_categoria'));
    }

    public function agregar_carrito(Producto $producto, Request $request)
    {
            #dd($request);
            $request->validate([
                'cantidad' => ['required', 'int', 'min:1','max:10']
            ]);
            $producto->users()->attach(auth()->id(),['cantidad' => $request->cantidad]);
            $user = Auth::user();
            $datos = [
                'user' => Auth::user(),
                'producto' => $producto,
                'cantidad' => $request->cantidad,
            ];
            Mail::to(Auth::user()->email)->send(new carrito($datos));
            return redirect()->route('principal');
        
    }

    public function show_carrito()
    {
        if(auth()->check())
        {
            $categorias = Categoria::take(4)->get();
            $nav_categoria = Categoria::where('id','>', $categorias->last()->id)->orderBy('id')->get();
            $user = Auth::user();
            
            $productoCarrito = $user->productos;
            #$productoCarrito = $user->productos()->with('categorias')->get();
            #dd($productoCarrito[0]);
           
            
            
            return view('principal.showCarrito',compact('productoCarrito','categorias','nav_categoria'));
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function editar_producto(Producto $producto)
    {
        #$edit = $producto->users;
        $data = $producto->users()->wherePivot('user_id', auth()->id())->first();
        if($data)
        {
            $datosPivote = $data->pivot;
            $categorias = Categoria::take(4)->get();
            $nav_categoria = Categoria::where('id','>', $categorias->last()->id)->orderBy('id')->get();
            return view('principal.edit_producto',compact('producto','nav_categoria','categorias', 'datosPivote'));
        }
        else
        {
            return abort(404);
        }
    }

    public function update_carrito(Producto $producto, Request $request)
    {
        $request->validate([
            'nueva_cantidad' => ['required', 'int', 'min:1']
        ]);
        $producto->users()->updateExistingPivot(auth()->id(),['cantidad' => $request->nueva_cantidad]);
        return redirect()->route('principal');

    }


    public function eliminar_carrito(Producto $producto)
    {
        if(auth()->check())
        {
            $user_id = auth()->id();
            $producto->users()->detach($user_id);
            return redirect()->route('principal');
        }
        else
        {
            return redirect()->route('principal');    
        }
    }
}
