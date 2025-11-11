<?php

namespace App\Http\Controllers;

use App\Models\valoraciones;
use App\Models\Usuario;   
use Illuminate\Http\Request;

class ValoracionesController extends Controller
{
    public function index()
    {
        $valoraciones = valoraciones::with('usuario')->get();
        return view('valoraciones.index', compact('valoraciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all(); // 👈 carga todos los usuarios
        return view('valoraciones.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        valoraciones::create($request->all());
        return redirect()->route('valoraciones.index')
                         ->with('success', 'Valoración creada correctamente');
    }

    public function edit($id)
    {
        $valoraciones = valoraciones::findOrFail($id);
        $usuarios = Usuario::all(); // 👈 también en edit
        return view('valoraciones.edit', compact('valoraciones', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $valoraciones = valoraciones::findOrFail($id);
        $valoraciones->update($request->all());

        return redirect()->route('valoraciones.index')
                         ->with('success','Valoración actualizada correctamente');
    }

    public function destroy($id)
    {
        $valoraciones = valoraciones::findOrFail($id);

        try {
            $valoraciones->delete();
            return redirect()->route('valoraciones.index')
                             ->with('success', 'Valoración eliminada correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('valoraciones.index')
                             ->with('error', 'No se puede eliminar esta valoración porque tiene entrenamientos asociados.');
        }
    }


    

    public function historial($id)
    {
    $valoracion = \App\Models\valoraciones::with(['usuario', 'historial.usuario'])->findOrFail($id);
    return view('valoraciones.historial', compact('valoraciones'));
    }


}