<?php

namespace App\Http\Controllers;

use App\Http\Requests\EjercicioRequest;
use App\Models\ejercicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EjerciciosController extends Controller
{
    public function index()
    {
        $ejercicios = ejercicios::all();
        return view('ejercicios.index', compact('ejercicios'));
    }

    public function create()
    {
        return view('ejercicios.create');
    }

    public function store(EjercicioRequest $request)
    {
        // ✅ Validación actualizada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string',
            'grupoMuscular' => 'required|string',
            'dificultad' => 'nullable|string',
            'duracionEstimada' => 'nullable|integer',
            'intensidad' => 'required|string',
            'equipoNecesario' => 'nullable|string',
            // Validaciones para imagen y video (archivo o URL)
            'imagen_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'imagen_url' => 'nullable|url',
            'video_file' => 'nullable|mimes:mp4,mov,avi,gif|max:10240', // 10MB para videos
            'video_url' => 'nullable|url',
        ]);

        $data = $request->all();

        // --- Lógica para la IMAGEN ---
        if ($request->hasFile('imagen_file')) {
            $data['imagenURL'] = $request->file('imagen_file')->store('ejercicios/imagenes', 'public');
            $data['imagenURL'] = Storage::url($data['imagenURL']); // Guardamos la URL completa
        } elseif ($request->filled('imagen_url')) {
            $data['imagenURL'] = $request->imagen_url;
        } else {
            $data['imagenURL'] = null; // Aseguramos que sea nulo si no se proporciona nada
        }

        // --- Lógica para el VIDEO ---
        if ($request->hasFile('video_file')) {
            $data['videoURL'] = $request->file('video_file')->store('ejercicios/videos', 'public');
            $data['videoURL'] = Storage::url($data['videoURL']); // Guardamos la URL completa
        } elseif ($request->filled('video_url')) {
            $data['videoURL'] = $request->video_url;
        } else {
            $data['videoURL'] = null;
        }

        // Eliminamos los campos de archivo del array de datos para no guardarlos en la BD
        unset($data['imagen_file'], $data['video_file']);

        ejercicios::create($data);

        return redirect()->route('ejercicios.index')->with('success', 'Ejercicio creado correctamente.');
    }

    public function edit($id)
    {
        $ejercicio = ejercicios::findOrFail($id);



        return view('ejercicios.edit', compact('ejercicio'));
    }

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
            'imagen_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'imagen_url' => 'nullable|url',
            'video_file' => 'nullable|mimes:mp4,mov,avi,gif|max:10240',
            'video_url' => 'nullable|url',
        ]);

        $data = $request->all();

        // --- Lógica para actualizar la IMAGEN ---
        if ($request->hasFile('imagen_file')) {
            // Eliminar imagen anterior si es un archivo local
            if ($ejercicio->imagenURL && str_starts_with($ejercicio->imagenURL, '/storage')) {
                $path = str_replace('/storage', '', $ejercicio->imagenURL);
                Storage::disk('public')->delete($path);
            }
            $data['imagenURL'] = $request->file('imagen_file')->store('ejercicios/imagenes', 'public');
            $data['imagenURL'] = Storage::url($data['imagenURL']);
        } elseif ($request->filled('imagen_url')) {
            // Si se proporciona una URL, eliminamos el archivo local anterior
            if ($ejercicio->imagenURL && str_starts_with($ejercicio->imagenURL, '/storage')) {
                $path = str_replace('/storage', '', $ejercicio->imagenURL);
                Storage::disk('public')->delete($path);
            }
            $data['imagenURL'] = $request->imagen_url;
        }
        // Si no se hace nada, se mantiene el valor actual de $ejercicio->imagenURL

        // --- Lógica para actualizar el VIDEO ---
        if ($request->hasFile('video_file')) {
            if ($ejercicio->videoURL && str_starts_with($ejercicio->videoURL, '/storage')) {
                $path = str_replace('/storage', '', $ejercicio->videoURL);
                Storage::disk('public')->delete($path);
            }
            $data['videoURL'] = $request->file('video_file')->store('ejercicios/videos', 'public');
            $data['videoURL'] = Storage::url($data['videoURL']);
        } elseif ($request->filled('video_url')) {
            if ($ejercicio->videoURL && str_starts_with($ejercicio->videoURL, '/storage')) {
                $path = str_replace('/storage', '', $ejercicio->videoURL);
                Storage::disk('public')->delete($path);
            }
            $data['videoURL'] = $request->video_url;
        }

        unset($data['imagen_file'], $data['video_file']);
        $ejercicio->update($data);

        return redirect()->route('ejercicios.index')->with('success', 'Ejercicio actualizado correctamente.');
    }

    public function destroy($id)
    {
        $ejercicio = ejercicios::FindorFail($id);
        try{

        // Eliminar imagen y video del almacenamiento si son archivos locales
        if ($ejercicio->imagenURL && str_starts_with($ejercicio->imagenURL, '/storage')) {
            $path = str_replace('/storage', '', $ejercicio->imagenURL);
            Storage::disk('public')->delete($path);
        }
        if ($ejercicio->videoURL && str_starts_with($ejercicio->videoURL, '/storage')) {
            $path = str_replace('/storage', '', $ejercicio->videoURL);
            Storage::disk('public')->delete($path);
        }

 
        $ejercicio -> delete();
        return redirect()->route('ejercicios.index')
        ->with('success', 'ejercicios eliminado correctamente.');
       }  catch (\Illuminate\Database\QueryException $e) {
        return redirect()->route('ejercicios.index')
                ->with('error', 'No se puede eliminar esta ejercicios porque tiene  entrenamientos asociadas.');
        }
       }
}
  