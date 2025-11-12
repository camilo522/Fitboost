<?php

namespace App\Http\Controllers;

use App\Models\PlanNutricional;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PlanNutricionalController extends Controller
{
    public function index()
    {
        $planes = PlanNutricional::with('usuario')->get();
        return view('planes_nutricionales.index', compact('planes'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        return view('planes_nutricionales.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'calorias_diarias' => 'required|integer|min:800',
            'proteinas_gramos' => 'required|integer|min:0',
            'carbohidratos_gramos' => 'required|integer|min:0',
            'grasas_gramos' => 'required|integer|min:0',
            'consejos_adicionales' => 'nullable|string',
        ]);

        // Si se crea un nuevo plan, desactivamos los anteriores del mismo usuario
        PlanNutricional::where('id_usuario', $request->id_usuario)->update(['activo' => false]);

        PlanNutricional::create($request->all());

        return redirect()->route('planes-nutricionlaes.index')->with('success', 'Plan creado correctamente.');
    }

    public function edit($id)
    {
        // Cambiado para que coincida con tu estilo
        $planNutricional = PlanNutricional::findOrFail($id);
        $usuarios = Usuario::all();

        return view('planes_nutricionales.edit', compact('planNutricional', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        // CAMBIO CLAVE: Ahora recibe $id, no el Modelo
        $planNutricional = PlanNutricional::findOrFail($id);

        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'calorias_diarias' => 'required|integer|min:800',
            'proteinas_gramos' => 'required|integer|min:0',
            'carbohidratos_gramos' => 'required|integer|min:0',
            'grasas_gramos' => 'required|integer|min:0',
            'consejos_adicionales' => 'nullable|string',
        ]);

        $planNutricional->update($request->all());

        return redirect()->route('planes-nutricionales.index')->with('success', 'Plan actualizado correctamente.');
    }

    public function destroy($id)
    {
        // CAMBIO CLAVE: Ahora recibe $id, no el Modelo
        $planNutricional = PlanNutricional::findOrFail($id);
        $planNutricional->delete();

        return redirect()->route('planes-nutricionales.index')->with('success', 'Plan eliminado correctamente.');
    }
}