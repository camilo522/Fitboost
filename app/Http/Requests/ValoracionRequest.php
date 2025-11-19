<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValoracionRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta solicitud.
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
            'idUsuario' => 'required|exists:usuarios,id',
            'fecha' => 'required|date',
            'altura' => 'required|integer|min:100|max:250',
            'peso' => 'required|numeric|min:20|max:300',
            'pecho' => 'required|integer|min:30|max:200',
            'cintura' => 'required|integer|min:30|max:200',
            'cadera' => 'required|integer|min:30|max:200',
            'brazoIzquierdo' => 'required|integer|min:10|max:80',
            'brazoDerecho' => 'required|integer|min:10|max:80',
            'antebrazoIzquierdo' => 'required|integer|min:10|max:70',
            'antebrazoDerecho' => 'required|integer|min:10|max:70',
            'piernaIzquierda' => 'required|integer|min:30|max:120',
            'piernaDerecha' => 'required|integer|min:30|max:120',
            'pantorrillaIzquierda' => 'required|integer|min:20|max:80',
            'pantorrillaDerecha' => 'required|integer|min:20|max:80',
            'fechaRegistro' => 'required|date',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'idUsuario.required' => 'El usuario es obligatorio.',
            

            'fecha.required' => 'La fecha de la valoración es obligatoria.',
            'fecha.date' => 'La fecha debe tener un formato válido (AAAA-MM-DD).',

            'altura.required' => 'La altura es obligatoria.',
            'altura.integer' => 'La altura debe ser un número  (en centímetros).',
            'altura.min' => 'La altura debe ser al menos de 100 cm.',
            'altura.max' => 'La altura no puede superar los 230 cm.',

            'peso.required' => 'El peso es obligatorio.',
            'peso.numeric' => 'El peso debe ser un número.',
            'peso.min' => 'El peso debe ser mayor a 20 kg.',
            'peso.max' => 'El peso no puede superar los 200 kg.',

            'pecho.required' => 'La medida del pecho es obligatoria.',
            'pecho.integer' => 'La medida del pecho debe ser un número entero.',
            'pecho.min' => 'La medida del pecho debe ser de al menos 20 cm.',
            'pecho.max' => 'La medida del pecho no puede superar los 200 cm.',

            'cintura.required' => 'La medida de la cintura es obligatoria.',
            'cintura.integer' => 'La medida de la cintura debe ser un número entero.',
            'cintura.min' => 'La medida de la cintura debe ser de al menos 10 cm.',
            'cintura.max' => 'La medida de la cintura no puede superar los 200 cm.',

            'cadera.required' => 'La medida de la cadera es obligatoria.',
            'cadera.integer' => 'La medida de la cadera debe ser un número entero.',
            'cadera.min' => 'La medida de la cadera debe ser de al menos 20 cm.',
            'cadera.max' => 'La medida de la cadera no puede superar los 200 cm.',

            'brazoIzquierdo.required' => 'La medida del brazo izquierdo es obligatoria.',
            'brazoIzquierdo.integer' => 'La medida del brazo izquierdo debe ser un número entero.',
            'brazoIzquierdo.min' => 'La medida del brazo izquierdo debe ser al menos 10 cm.',
            'brazoIzquierdo.max' => 'La medida del brazo izquierdo no puede superar los 80 cm.',

            'brazoDerecho.required' => 'La medida del brazo derecho es obligatoria.',
            'brazoDerecho.integer' => 'La medida del brazo derecho debe ser un número entero.',
            'brazoDerecho.min' => 'La medida del brazo derecho debe ser al menos 10 cm.',
            'brazoDerecho.max' => 'La medida del brazo derecho no puede superar los 80 cm.',

            'antebrazoIzquierdo.required' => 'La medida del antebrazo izquierdo es obligatoria.',
            'antebrazoIzquierdo.integer' => 'La medida del antebrazo izquierdo debe ser un número entero.',
            'antebrazoIzquierdo.min' => 'La medida del antebrazo izquierdo debe ser al menos 8 cm.',
            'antebrazoIzquierdo.max' => 'La medida del antebrazo izquierdo no puede superar los 70 cm.',

            'antebrazoDerecho.required' => 'La medida del antebrazo derecho es obligatoria.',
            'antebrazoDerecho.integer' => 'La medida del antebrazo derecho debe ser un número entero.',
            'antebrazoDerecho.min' => 'La medida del antebrazo derecho debe ser al menos 8 cm.',
            'antebrazoDerecho.max' => 'La medida del antebrazo derecho no puede superar los 70 cm.',

            'piernaIzquierda.required' => 'La medida de la pierna izquierda es obligatoria.',
            'piernaIzquierda.integer' => 'La medida de la pierna izquierda debe ser un número entero.',
            'piernaIzquierda.min' => 'La medida de la pierna izquierda debe ser al menos 30 cm.',
            'piernaIzquierda.max' => 'La medida de la pierna izquierda no puede superar los 120 cm.',

            'piernaDerecha.required' => 'La medida de la pierna derecha es obligatoria.',
            'piernaDerecha.integer' => 'La medida de la pierna derecha debe ser un número entero.',
            'piernaDerecha.min' => 'La medida de la pierna derecha debe ser al menos 30 cm.',
            'piernaDerecha.max' => 'La medida de la pierna derecha no puede superar los 120 cm.',

            'pantorrillaIzquierda.required' => 'La medida de la pantorrilla izquierda es obligatoria.',
            'pantorrillaIzquierda.integer' => 'La medida de la pantorrilla izquierda debe ser un número entero.',
            'pantorrillaIzquierda.min' => 'La medida de la pantorrilla izquierda debe ser al menos 10 cm.',
            'pantorrillaIzquierda.max' => 'La medida de la pantorrilla izquierda no puede superar los 80 cm.',

            'pantorrillaDerecha.required' => 'La medida de la pantorrilla derecha es obligatoria.',
            'pantorrillaDerecha.integer' => 'La medida de la pantorrilla derecha debe ser un número entero.',
            'pantorrillaDerecha.min' => 'La medida de la pantorrilla derecha debe ser al menos 10 cm.',
            'pantorrillaDerecha.max' => 'La medida de la pantorrilla derecha no puede superar los 80 cm.',

            'fechaRegistro.required' => 'La fecha de registro es obligatoria.',
            'fechaRegistro.date' => 'La fecha de registro debe tener un formato válido (AAAA-MM-DD).',
        ];
    }
}
