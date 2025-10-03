<?php

namespace App\Http\Controllers;

use App\Models\ejercicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EjerciciosController extends Controller
{
    /**
     * Mostrar listado de ejercicios
     */
    public function index()
    {
        $ejercicios = ejercicios::all();
        return view('ejercicios.index', compact('ejercicios'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('ejercicios.create');
    }

    /**
     * Guardar nuevo ejercicio
     */
    public function store(Request $request)
{
    // ✅ Validación
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'categoria' => 'required|string',
        'grupoMuscular' => 'required|string',
        'dificultad' => 'nullable|string',
        'duracionEstimada' => 'nullable|integer',
        'intensidad' => 'required|string',
        'equipoNecesario' => 'nullable|string',
        'imagenURL' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        'imagen_externa' => 'nullable|url', // 👈 para enlaces externos
        'videoURL' => 'nullable|string'
    ]);

    // ✅ Obtenemos todos los datos
    $data = $request->except('imagen_externa');

    // 📌 Lógica para manejar la imagen
    if ($request->hasFile('imagenURL')) {
        // Si se subió un archivo, lo guardamos en storage/app/public/ejercicios
        $data['imagenURL'] = $request->file('imagenURL')->store('ejercicios', 'public');
    } elseif ($request->filled('imagen_externa')) {
        // Si no se subió archivo, pero hay un link externo, lo guardamos tal cual
        $data['imagenURL'] = $request->input('imagen_externa');
    }

    // ✅ Guardamos el ejercicio
    ejercicios::create($data);

    // 🔄 Redirigimos al index
    return redirect()->route('ejercicios.index');
}

    /**
     * Mostrar formulario de edición
     */
    public function edit($id)
    {
        $ejercicio = ejercicios::findOrFail($id);
        return view('ejercicios.edit', compact('ejercicio'));
    }

    /**
     * Actualizar un ejercicio existente
     */
    public function update(Request $request, $id)
    {
        $ejercicio = ejercicios::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string',
            'grupoMuscular' => 'required|string',
            'dificultad' => 'nullable|string',
            'duracionEstimada' => 'nullable|integer',
            'intensidad' => 'required|string',
            'equipoNecesario' => 'nullable|string',
            'imagenURL' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'videoURL' => 'nullable|string'
        ]);

        $data = $request->all();

        // Actualizar imagen si se sube una nueva
        if ($request->hasFile('imagenURL')) {
            // Eliminar imagen anterior si existe
            if ($ejercicio->imagenURL && Storage::disk('public')->exists($ejercicio->imagenURL)) {
                Storage::disk('public')->delete($ejercicio->imagenURL);
            }
            $data['imagenURL'] = $request->file('imagenURL')->store('ejercicios', 'public');
        } else {
            // Mantener imagen actual si no se sube nueva
            $data['imagenURL'] = $ejercicio->imagenURL;
        }

        $ejercicio->update($data);

        return redirect()->route('ejercicios.index')->with('success', 'Ejercicio actualizado correctamente');
    }

    /**
     * Eliminar ejercicio
     */
    public function destroy($id)
    {
        $ejercicio = ejercicios::findOrFail($id);

        // Eliminar imagen del almacenamiento si existe
        if ($ejercicio->imagenURL && Storage::disk('public')->exists($ejercicio->imagenURL)) {
            Storage::disk('public')->delete($ejercicio->imagenURL);
        }

        $ejercicio->delete();

        return redirect()->route('ejercicios.index')->with('success', 'Ejercicio eliminado correctamente');
    }
}
