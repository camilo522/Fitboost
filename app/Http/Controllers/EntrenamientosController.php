<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntrenamientoRequest;
use App\Models\entrenamientos;
use Illuminate\Http\Request;

class EntrenamientosController extends Controller
{
    /**
     * Muestra todos los entrenamientos.
     */
    public function index()
    {
        $entrenamientos = entrenamientos::all();
        return view('entrenamientos.index', compact('entrenamientos'));
    }

    /**
     * Muestra el formulario de creación.
     */
    public function create()
    {
        return view('entrenamientos.create');
    }

    /**
     * Guarda un nuevo entrenamiento.
     */
    public function store(EntrenamientoRequest $request)
    {
        // 🔒 Validación básica
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'objetivo' => 'nullable|string|max:50',
            'duracion' => 'nullable|string|max:20',
            'nivel' => 'required|in:Principiante,Intermedio,Avanzado',
            'diasSemana' => 'nullable|string|max:50',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        entrenamientos::create($request->all());

        return redirect()
            ->route('entrenamientos.index')
            ->with('success', 'Entrenamiento creado correctamente.');
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit($id)
    {
        $entrenamiento = entrenamientos::findOrFail($id);
        return view('entrenamientos.edit', compact('entrenamiento'));
    }

    /**
     * Actualiza un entrenamiento existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'objetivo' => 'nullable|string|max:50',
            'duracion' => 'nullable|string|max:20',
            'nivel' => 'required|in:Principiante,Intermedio,Avanzado',
            'diasSemana' => 'nullable|string|max:50',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $entrenamiento = entrenamientos::findOrFail($id);
        $entrenamiento->update($request->all());

        return redirect()
            ->route('entrenamientos.index')
            ->with('success', 'Entrenamiento actualizado correctamente.');
    }

    /**
     * Elimina un entrenamiento.
     */
    public function destroy( $id)
    {
    {
        
        $entrenamiento = entrenamientos::FindorFail($id);
        try{
        $entrenamiento -> delete();
        return redirect()->route('entrenamientos.index')
        ->with('success', 'Entrenamiento eliminado correctamente.');
       }  catch (\Illuminate\Database\QueryException $e) {
        return redirect()->route('entrenamientos.index')
                ->with('error', 'No se puede eliminar este Entrenamiento porque tiene Rutinas asociadas.');
        }
    }
    }
}
