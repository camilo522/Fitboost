<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EjercicioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'             => 'required|string|min:3|max:100',
            'descripcion'        => 'required|string|min:10|max:3000',

            'categoria'          => 'required|string|max:50',
            'grupoMuscular'      => 'required|string|max:50',
            'dificultad'         => 'required|string|max:50',

            'duracionEstimada'   => 'required|integer|min:1|max:600',

            'intensidad'         => 'required|string|max:50',
            'equipoNecesario'    => 'required|string|max:100',

            'imagenURL'          => 'nullable|url|max:255',
            'videoURL'           => 'nullable|url|max:255',
        ];
    }

    public function messages(): array
    {
        return [

            // ⭐ NOMBRE
            'nombre.required' => 'El nombre del ejercicio es obligatorio.',
            'nombre.string' => 'El nombre del ejercicio debe contener únicamente texto.',
            'nombre.min' => 'El nombre del ejercicio debe tener mínimo 3 caracteres.',
            'nombre.max' => 'El nombre del ejercicio no puede exceder los 100 caracteres.',

            // ⭐ DESCRIPCIÓN
            'descripcion.required' => 'La descripción del ejercicio es obligatoria.',
            'descripcion.string' => 'La descripción del ejercicio debe ser texto plano.',
            'descripcion.min' => 'La descripción del ejercicio debe contener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción del ejercicio no puede superar los 3000 caracteres.',

            // ⭐ CATEGORÍA
            'categoria.required' => 'La categoría del ejercicio es obligatoria.',
            'categoria.string' => 'La categoría del ejercicio debe ser texto.',
            'categoria.max' => 'La categoría del ejercicio no puede exceder los 50 caracteres.',

            // ⭐ GRUPO MUSCULAR
            'grupoMuscular.required' => 'El grupo muscular del ejercicio es obligatorio.',
            'grupoMuscular.string' => 'El grupo muscular debe ser texto.',
            'grupoMuscular.max' => 'El grupo muscular no puede exceder los 50 caracteres.',

            // ⭐ DIFICULTAD
            'dificultad.required' => 'La dificultad del ejercicio es obligatoria.',
            'dificultad.string' => 'La dificultad del ejercicio debe ser texto.',
            'dificultad.max' => 'La dificultad no puede tener más de 50 caracteres.',

            // ⭐ DURACIÓN ESTIMADA
            'duracionEstimada.required' => 'La duración estimada del ejercicio es obligatoria.',
            'duracionEstimada.integer' => 'La duración estimada debe ser un número entero.',
            'duracionEstimada.min' => 'La duración mínima permitida es de 1 minuto.',
            'duracionEstimada.max' => 'La duración estimada no puede superar los 600 minutos.',

            // ⭐ INTENSIDAD
            'intensidad.required' => 'La intensidad del ejercicio es obligatoria.',
            'intensidad.string' => 'La intensidad debe ser texto.',
            'intensidad.max' => 'La intensidad no puede exceder los 50 caracteres.',

            // ⭐ EQUIPO NECESARIO
            'equipoNecesario.required' => 'El equipo necesario es obligatorio.',
            'equipoNecesario.string' => 'El equipo necesario debe ser texto.',
            'equipoNecesario.max' => 'El equipo necesario no puede exceder los 100 caracteres.',

            // ⭐ IMAGEN URL
            'imagenURL.url' => 'La imagen debe ser una URL válida.',
            'imagenURL.max' => 'La URL de la imagen no puede superar los 255 caracteres.',

            // ⭐ VIDEO URL
            'videoURL.url' => 'El video debe ser una URL válida.',
            'videoURL.max' => 'La URL del video no puede superar los 255 caracteres.',
        ];
    }
}
