<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntrenamientoRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta petición.
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
        $rules = [
           
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:800',
            'objetivo' => 'required|string|max:100',
            'duracion' => 'required|string|max:20',
            'nivel' => 'required|in:Principiante,Intermedio,Avanzado',
            'diasSemana' => 'required|string|max:50',
            
        ];

        return $rules;
    }

    /**
     * Mensajes personalizados de error.
     */
    public function messages(): array
    {
        return [
            
            'nombre.required' => 'El nombre del entrenamiento es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',

            'descripcion.required' => 'La descripción del entrenamiento es obligatoria.',
            'descripcion.max' => 'La descripción no puede tener más de 800 caracteres.',

            'objetivo.required' => 'El objetivo del entrenamiento es obligatorio.',
            'objetivo.max' => 'El objetivo no puede superar los 100 caracteres.',

            'duracion.required' => 'El duracion del entrenamiento es obligatorio.',
            'duracion.max' => 'La duración no puede superar los 20 caracteres.',

            'nivel.required' => 'Debe seleccionar un nivel.',

            'diasSemana.required' => 'El diasSemana del entrenamiento es obligatorio.',
            'diasSemana.max' => 'El campo días por semana no puede superar los 50 caracteres.',

        ];
    }
}
