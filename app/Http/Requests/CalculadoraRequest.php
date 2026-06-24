<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculadoraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'peso'   => 'required|numeric|min:20|max:300',
            'altura' => 'required|numeric|min:110|max:280',
            'edad'   => 'required|integer|min:5|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'peso.required'   => 'El peso es obligatorio.',
            'peso.numeric'    => 'El peso debe ser un número válido.',
            'peso.min'        => 'El peso no puede ser menor a 20 kg.',
            'peso.max'        => 'El peso no puede ser mayor a 300 kg.',

            'altura.required' => 'La altura es obligatoria.',
            'altura.numeric'  => 'La altura debe ser un número válido.',
            'altura.min'      => 'La altura no puede ser menor a 110 cm.',
            'altura.max'      => 'La altura no puede ser mayor a 280 cm.',

            'edad.required'   => 'La edad es obligatoria.',
            'edad.integer'    => 'La edad debe ser un número entero.',
            'edad.min'        => 'La edad mínima es 5 años.',
            'edad.max'        => 'La edad máxima permitida es 100 años.',
        ];
    }
}
