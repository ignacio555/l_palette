<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        $categorias = Categoria::all();
        return view('categorias.indexCategoria', compact('categorias'));
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
        return view('categorias.createCategoria');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        $request->validate(
            [
                'dato' => ['required', 'string', 'regex:/^[a-zA-Z]+$/', 'max:10']
            ]
            );

        $categorias = new Categoria();
        $categorias-> dato = $request->dato;
        $categorias->save();
        return redirect()->route('categoria.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        $productos = $categoria->productos()->get();
        return view('categorias.showCategorias',compact('categoria', 'productos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        return view('categorias.editCategoria', compact('categoria'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        $request->validate(
            [
                'dato' => ['required', 'string', 'regex:/^[a-zA-Z]+$/', 'max:10']
            ]
        );
        $categoria-> dato = $request->dato;
        $categoria->save();
        return redirect()->route('categoria.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        if (!Gate::allows('rol', Auth::user())) {
            abort(404);
        }   
        #dd($categoria);
        $categoria->productos()->delete();
        $categoria->delete();
        return redirect()->route('categoria.index');
    }
}
