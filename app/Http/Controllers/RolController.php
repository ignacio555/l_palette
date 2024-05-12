<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $users = User::get();
        $user = Auth::user();
        $datos = $user->roles;
        #dd($user->roles);
        return view('roles.createRole', compact('users'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'string', 'max:255']
        ]);
        
        $rol = new Rol();
        $rol->dato = 1;
        $rol->user_id = $request->user_id;
        $rol->save();
        return redirect()->route('producto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rol $rol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
        //
    }
}
