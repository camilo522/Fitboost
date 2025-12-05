<?php

namespace App\Http\Controllers;

use App\Http\Requests\RutinaRequest;
use App\Models\entrenamientos;
use App\Models\rutinas;
use App\Models\Usuario;

use Illuminate\Http\Request;

class RutinasController extends Controller
{
    public function index()
    {
        $rutinas = rutinas::all();
        $usuarios = usuario::all();  

        
        return view('rutinas.index', compact('rutinas', 'usuarios'));
    }

    public function create()
    {
        $entrenamientos = entrenamientos::all();
        return view('rutinas.create', compact('entrenamientos'));
    }

    public function store(RutinaRequest $request)
    {
        rutinas::create($request->all());
        return redirect()->route('rutinas.index')->with('success', 'Rutina creada correctamente');
    }

    public function edit($id)
    {
        $rutinas = rutinas::findOrFail($id);
        $entrenamientos = entrenamientos::all();
        return view('rutinas.edit', compact('rutinas', 'entrenamientos'));
    }

    public function update(Request $request, $id)
    {
        $rutinas = rutinas::findOrFail($id);
        $rutinas->update($request->all());

        return redirect()->route('rutinas.index')->with('success','Rutina actualizada correctamente');
    }

    public function destroy($id)
    {
        $rutina = rutinas::findOrFail($id);

        try {
            $rutina->delete();
            return redirect()->route('rutinas.index')
                ->with('success', 'Rutina eliminada correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('rutinas.index')
                ->with('error', 'No se puede eliminar esta rutina porque tiene entrenamientos asociados.');
        }
    }

    // ============================
    //   OPCIÓN 2: Asignar a usuario
    // ============================

    // 1️⃣ Mostrar lista de usuarios para asignar
    public function seleccionarUsuario($id)
    {
        $rutina = rutinas::findOrFail($id);
        $usuarios = Usuario::all();  // ← Modelo correcto

        return view('rutinas.asignar', compact('rutina', 'usuarios'));
    }

    // 2️⃣ Asignar la rutina al usuario seleccionado
    public function asignar(Request $request, $id)
{
    $rutina = rutinas::findOrFail($id);

    $usuario = Usuario::find($request->usuario_id);

    if (!$usuario) {
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }

    $usuario->rutina_id = $rutina->id;
    $usuario->save();

    return redirect()->back()->with('success', 'Rutina asignada correctamente.');
}

}
