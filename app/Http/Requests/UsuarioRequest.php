<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para crear o actualizar un usuario.
     */
    public function rules(): array
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:usuarios,email,' . $this->route('usuario')],
            'fechaRegistro' => ['required', 'date'],
        ];

        if ($this->isMethod('post')) {
            // Reglas para crear
            $rules['contrasena'] = ['required', 'string', 'min:8', 'confirmed'];
        } else {
            // Reglas para actualizar
            $rules['contrasena'] = ['nullable', 'string', 'min:8', 'confirmed'];
        }

        return $rules;
    }

    /**
     * Mensajes personalizados de validación.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
            'nombre.string'   => 'El nombre debe ser texto.',
            'nombre.min'      => 'El nombre debe tener al menos 3 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'contrasena.required' => 'La contraseña es obligatoria al crear un usuario.',
            'contrasena.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'contrasena.confirmed' => 'La confirmación de la contraseña no coincide.',

            'fechaRegistro.required' => 'El nombre es obligatorio.',
            'fechaRegistro.date' => 'La fecha de registro debe tener un formato válido.',
            'fechaRegistro.required' => 'La fecha de registro es obligatoria.',
        ];
    }
}
