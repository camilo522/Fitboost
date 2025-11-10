<?php

namespace App\Http\Controllers;

use App\Models\Valoraciones;
use App\Models\Usuario;
use App\Models\HistorialValoracion;
use Illuminate\Http\Request;

class ValoracionesController extends Controller
{
    public function index()
    {
        $valoraciones = Valoraciones::with('usuario')->get();
        return view('valoraciones.index', compact('valoraciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        return view('valoraciones.create', compact('usuarios'));
    }

   public function store(Request $request)
    {
    // ✅ Validación
    $validated = $request->validate([
        'idUsuario' => 'required|exists:usuarios,id',
        'fecha' => 'required|date',
        'peso' => 'required|numeric|min:0',
        'altura' => 'required|numeric|min:0',
        'pecho' => 'nullable|numeric|min:0',
        'cintura' => 'nullable|numeric|min:0',
        'cadera' => 'nullable|numeric|min:0',
        'brazoIzquierdo' => 'nullable|numeric|min:0',
        'brazoDerecho' => 'nullable|numeric|min:0',
        'antebrazoIzquierdo' => 'nullable|numeric|min:0',
        'antebrazoDerecho' => 'nullable|numeric|min:0',
        'piernaIzquierda' => 'nullable|numeric|min:0',
        'piernaDerecha' => 'nullable|numeric|min:0',
        'pantorrillaIzquierda' => 'nullable|numeric|min:0',
        'pantorrillaDerecha' => 'nullable|numeric|min:0',
        'fechaRegistro' => 'nullable|date'
    ]);

    // ✅ Crear nueva valoración
    $valoracion = Valoraciones::create($validated);

    // ✅ AHORA SÍ, registrar en historial MANUALMENTE
    

    return redirect()->route('valoraciones.index')
                     ->with('success', 'Valoración creada correctamente');
    }


    public function edit($id)
    {
        $valoraciones = Valoraciones::findOrFail($id);
        $usuarios = Usuario::all();
        return view('valoraciones.edit', compact('valoraciones', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
    $valoracion = Valoraciones::findOrFail($id);

    // ✅ Validar datos antes de actualizar
    $validated = $request->validate([
        'idUsuario' => 'required|exists:usuarios,id',
        'fecha' => 'required|date',
        'peso' => 'required|numeric|min:0',
        'altura' => 'required|numeric|min:0',
        'pecho' => 'nullable|numeric|min:0',
        'cintura' => 'nullable|numeric|min:0',
        'cadera' => 'nullable|numeric|min:0',
        'brazoIzquierdo' => 'nullable|numeric|min:0',
        'brazoDerecho' => 'nullable|numeric|min:0',
        'antebrazoIzquierdo' => 'nullable|numeric|min:0',
        'antebrazoDerecho' => 'nullable|numeric|min:0',
        'piernaIzquierda' => 'nullable|numeric|min:0',
        'piernaDerecha' => 'nullable|numeric|min:0',
        'pantorrillaIzquierda' => 'nullable|numeric|min:0',
        'pantorrillaDerecha' => 'nullable|numeric|min:0',
        'fechaRegistro' => 'nullable|date'
    ]);

    // ✅ Actualizar los datos
    $valoracion->update($validated);

    // ✅ AHORA SÍ, registrar en historial MANUALMENTE
    

    return redirect()->route('valoraciones.index')
                     ->with('success', 'Valoración actualizada correctamente');
    }

    public function destroy($id)
    {
        $valoracion = Valoraciones::findOrFail($id);

        try {
            $valoracion->delete();
            return redirect()->route('valoraciones.index')
                             ->with('success', 'Valoración eliminada correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('valoraciones.index')
                             ->with('error', 'No se puede eliminar esta valoración porque tiene entrenamientos asociados.');
        }
    }

    public function historial($id)
    {
        $valoracion = Valoraciones::with(['usuario', 'historial.usuario'])->findOrFail($id);
        return view('valoraciones.historial', compact('valoracion'));
    }
}

