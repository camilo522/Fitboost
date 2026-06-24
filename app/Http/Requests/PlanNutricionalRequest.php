<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanNutricionalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_usuario' => 'required|exists:usuarios,id',

            'calorias_diarias' => 'required|integer|min:500|max:10000',
            'proteinas_gramos' => 'required|integer|min:0|max:500',
            'carbohidratos_gramos' => 'required|integer|min:0|max:1000',
            'grasas_gramos' => 'required|integer|min:0|max:500',

            'consejos_adicionales' => 'nullable|string|min:5|max:5000',

            'activo' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [

            // ⭐ id_usuario
            'id_usuario.required' => 'El usuario del plan nutricional es obligatorio.',
            'id_usuario.exists' => 'El usuario del plan nutricional no existe en el sistema.',

            // ⭐ calorías diarias
            'calorias_diarias.required' => 'Las calorías diarias del plan nutricional son obligatorias.',
            'calorias_diarias.integer' => 'Las calorías diarias del plan nutricional deben ser un número entero.',
            'calorias_diarias.min' => 'Las calorías diarias del plan nutricional deben ser como mínimo 500.',
            'calorias_diarias.max' => 'Las calorías diarias del plan nutricional no pueden exceder las 10000.',

            // ⭐ proteínas
            'proteinas_gramos.required' => 'Las proteínas del plan nutricional son obligatorias.',
            'proteinas_gramos.integer' => 'Las proteínas del plan nutricional deben ser un número entero.',
            'proteinas_gramos.min' => 'Las proteínas del plan nutricional no pueden ser negativas.',
            'proteinas_gramos.max' => 'Las proteínas del plan nutricional no pueden superar los 500 gramos.',

            // ⭐ carbohidratos
            'carbohidratos_gramos.required' => 'Los carbohidratos del plan nutricional son obligatorios.',
            'carbohidratos_gramos.integer' => 'Los carbohidratos del plan nutricional deben ser un número entero.',
            'carbohidratos_gramos.min' => 'Los carbohidratos del plan nutricional no pueden ser negativos.',
            'carbohidratos_gramos.max' => 'Los carbohidratos del plan nutricional no pueden superar los 1000 gramos.',

            // ⭐ grasas
            'grasas_gramos.required' => 'Las grasas del plan nutricional son obligatorias.',
            'grasas_gramos.integer' => 'Las grasas del plan nutricional deben ser un número entero.',
            'grasas_gramos.min' => 'Las grasas del plan nutricional no pueden ser negativas.',
            'grasas_gramos.max' => 'Las grasas del plan nutricional no pueden superar los 500 gramos.',

            // ⭐ consejos adicionales
            'consejos_adicionales.string' => 'Los consejos adicionales del plan nutricional deben ser texto.',
            'consejos_adicionales.min' => 'Los consejos adicionales del plan nutricional deben contener al menos 5 caracteres.',
            'consejos_adicionales.max' => 'Los consejos adicionales del plan nutricional no pueden exceder los 5000 caracteres.',

            // ⭐ activo
            'activo.required' => 'El estado (activo/inactivo) del plan nutricional es obligatorio.',
            'activo.boolean' => 'El estado del plan nutricional debe ser verdadero o falso.',
        ];
    }
}
