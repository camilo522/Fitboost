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
        usuario::create( $request->all());

        return redirect()->route('usuario.index'); //->with('success', 'usuario creada correctamente')/
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
            // Busca al usuario (usando el nombre del modelo en PascalCase es mejor práctica)
            $usuario = Usuario::findOrFail($id);

            // Validación corregida
            $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:usuarios,email,' . $usuario->id, // Tabla corregida
                'contrasena' => 'nullable|string|min:8|confirmed',
                'fechaRegistro' => 'required|date', // Añadida validación para la fecha
            ]);

            // Actualiza los datos del usuario (nombres de campo corregidos)
            $usuario->nombre = $request->nombre;
            $usuario->email = $request->email;
            $usuario->fechaRegistro = $request->fechaRegistro; // Línea añadida

            // Solo actualiza la contraseña si el usuario escribió una nueva
            if ($request->filled('contrasena')) {
                $usuario->contrasena = bcrypt($request->contrasena);
            }

            // Guarda los cambios
            $usuario->save();

            return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente.');
        }
    /**
     * Remove the specified resource from storage.
     */
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
