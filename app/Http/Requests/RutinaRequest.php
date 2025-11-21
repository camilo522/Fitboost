<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RutinaRequest extends FormRequest
{
    /**
     * Autorizar el request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'idEntrenamiento' => 'required|exists:entrenamientos,id',
            'nombre' => 'required|string|min:3|max:100',
            'horario' => 'required|date_format:H:i',
            'descripcion' => 'required|string|min:10|max:2000',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            // idEntrenamiento
            'idEntrenamiento.required' => 'El entrenamiento es obligatorio.',
            'idEntrenamiento.exists' => 'El entrenamiento seleccionado no existe en la base de datos.',

            // nombre
            'nombre.required' => 'El nombre de la rutina es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',

            // horario
            'horario.required' => 'El horario es obligatorio.',
            'horario.date_format' => 'El horario debe tener el formato HH:MM (por ejemplo, 14:30).',

            // descripcion
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción no puede superar los 2000 caracteres.',
        ];
    }
}
