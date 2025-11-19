<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EjercicioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permite usarlo sin restricciones
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
            'categoria' => 'nullable|string|max:100',
            'grupoMuscular' => 'nullable|string|max:100',
            'dificultad' => 'nullable|string|max:50',
            'duracionEstimada' => 'nullable|integer|min:1|max:300',
            'intensidad' => 'nullable|string|max:50',
            'equipoNecesario' => 'nullable|string|max:255',
            'imagenURL' => 'nullable|url|max:255',
            'videoURL' => 'nullable|url|max:255',
        ];
    }
}
