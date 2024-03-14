<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
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
        $productos = Producto::all();
        return view("producto/indexProducto", compact('productos'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {                     

        return view('producto.createProducto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'min:10'],
            'imagen'=> ['required','file','mimes:jpg,png']
        ]);
        #Producto::created($request->all());
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->categoria = $request->categoria;
        $producto->descripcion = $request->descripcion;
        $file = $request->file('imagen');
        $path = $file->store('images_productos','public');
        $producto->url = $path;
        $producto->save();
        return redirect()->route('producto.index');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('producto/showProducto', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
        return view('producto.editproducto', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
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
