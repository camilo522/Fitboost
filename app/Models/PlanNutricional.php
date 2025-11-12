<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Buena práctica añadirlo
use Illuminate\Database\Eloquent\Model;

class PlanNutricional extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'planes_nutricionales'; // <-- ¡ESTA ES LA LÍNEA CLAVE!

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id_usuario',
        'calorias_diarias',
        'proteinas_gramos',
        'carbohidratos_gramos',
        'grasas_gramos',
        'consejos_adicionales',
        'activo'
    ];

    /**
     * Un plan nutricional pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}