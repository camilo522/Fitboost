<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = usuario::all();

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */

    

    


    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required',
        'email' => 'required|email|unique:usuarios,email',
        'password' => 'required|min:4',
        'fechaRegistro' => 'required|date'
    ]);

    Usuario::create([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'fechaRegistro' => $request->fechaRegistro
    ]);

    return redirect()->route('usuario.index')
        ->with('success', 'Usuario creado correctamente.');
}


    /**
     * Display the specified resource.
     */
    public function show(usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = usuario::FindorFail($id);

        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
   
     public function update(Request $request, $id)
{
    $usuario = Usuario::findOrFail($id);

    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:usuarios,email,' . $usuario->id,
        'password' => 'nullable|string|min:8|confirmed',
        'fechaRegistro' => 'required|date',
    ]);

    $usuario->nombre = $request->nombre;
    $usuario->email = $request->email;
    $usuario->fechaRegistro = $request->fechaRegistro;

    if ($request->filled('password')) {
        $usuario->password = $request->password; // mutator lo hashea
    }

    $usuario->save();

    // 🔹 Cambiado para redirigir al listado de usuarios
    return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente');
}



    public function destroy( $id)
    {
        {
        {

            $usuario = usuario::findOrFail($id);
         $usuario->delete();

       return redirect()->route('usuario.index');
        /*$usuario = usuario::FindorFail($id);
        try{
        $usuario -> delete();
        return redirect()->route('usuario.index')
        /*->with('success','usuario Eliminado correctamente');
        }  catch (\Illuminate\Database\QueryException $e) {
        return redirect()->route('usuario.index')
        ->with('error', 'No se puede eliminar este usuario porque tiene visualizaciones asociadas.');*/
        }
    }
    }
    }
