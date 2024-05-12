<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        #$productos = Producto::all();
        $productos = Producto::with('categorias')->get();
        return view("producto/indexProducto", compact('productos'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {              
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }          
        $categorias = Categoria::all();
        return view('producto.createProducto', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'categoria_id' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'min:10'],
            'imagen'=> ['required','file','mimes:jpg,png'],
            'precio'=> ['required','numeric']
        ]);
        #Producto::created($request->all());
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        #$producto->categoria = $request->categoria;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $file = $request->file('imagen');
        $path = $file->store('images_productos','public');
        $producto->url = $path;
        $producto->save();
        $producto->categorias()->attach($request->categoria_id);
        return redirect()->route('producto.index');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        return view('producto/showProducto', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        return view('producto.editproducto', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'min:10'],
            'imagen'=> ['file','mimes:jpg,png']
        ]);
        
        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->descripcion = $request->descripcion;
        if($request->hasFile('imagen'))
        {
            $file = $request->file('imagen');
            $path = $file->store('images_productos','public');
            $producto->url = $path;
        }
        $producto->save();
        return redirect()->route('producto.index');
    }


    public function destroy(Producto $producto)
    {
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
       // dd(Storage::exists('public/' . $producto->url));
        if(Storage::exists('public/' . $producto->url))
        {
            Storage::delete('public/' . $producto->url);
            $producto->delete();
            return redirect()->route('producto.index');
        }
        else
        {
            return redirect()->route('producto.index')->with('error', 'La imagen no existe');
        }
    }
}
