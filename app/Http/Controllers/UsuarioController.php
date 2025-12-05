<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PlanNutricional;
use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Usuario::create($request->all());

        return redirect()->route('usuario.index');
    }

    /**
     * Display the specified resource (PERFIL DEL USUARIO).
     */
    

    public function show($id)
{
    $usuario = Usuario::findOrFail($id);

    // Última valoración
    $ultimaValoracion = $usuario->valoraciones()
        ->orderBy('created_at', 'desc')
        ->first();

    // Obtener el plan nutricional activo del usuario
    $planNutricional = PlanNutricional::where('id_usuario', $id)
        ->where('activo', true)
        ->first();

    return view('usuarios.perfil', compact(
        'usuario',
        'ultimaValoracion',
        'planNutricional'
    ));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|string|min:8|confirmed',
            'fechaRegistro' => 'required|date',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->fechaRegistro = $request->fechaRegistro;

        if ($request->filled('password')) {
            $usuario->password = $request->password; // Mutator lo hashea
        }

        $usuario->save();

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        try {
            $usuario->delete();

            return redirect()->route('usuario.index')
                ->with('success', 'Usuario eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('usuario.index')
                ->with('error', 'No se puede eliminar este usuario porque tiene valoraciones asociadas.');
        }
    }

public function subirFoto(Request $request, $id)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    $usuario = Usuario::findOrFail($id);

    $nombre = time() . '.' . $request->foto->extension();

    // GUARDAR EN STORAGE
    $request->foto->storeAs('public/imagenes/perfiles', $nombre);

    $usuario->foto = $nombre;
    $usuario->save();

    return back()->with('success', 'Foto actualizada correctamente');
}



/**
 * Exportar perfil del usuario a PDF (clase: dompdf)
 */
public function exportar($id)
{
    $usuario = Usuario::findOrFail($id);

    // Última valoración
    $ultimaValoracion = $usuario->valoraciones()
        ->orderBy('created_at', 'desc')
        ->first();

    // Plan nutricional activo (si existe)
    $planNutricional = PlanNutricional::where('id_usuario', $id)
        ->where('activo', true)
        ->first();

    // Historial (últimos 6 registros)
    $valoracionesHistorico = $usuario->valoraciones()
        ->orderBy('created_at', 'asc')
        ->get()
        ->pluck('imc');

    // Pasamos datos a la vista pdf
    $data = compact('usuario', 'ultimaValoracion', 'planNutricional', 'valoracionesHistorico');

    $pdf = Pdf::loadView('usuarios.pdf', $data)
        ->setPaper('a4', 'portrait');

    $filename = 'perfil_usuario_' . $usuario->id . '.pdf';

    return $pdf->download($filename);
}

    public function asignarRutina(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'rutina_id' => 'required|exists:rutinas,id',
        ]);

        $usuario->rutina_id = $request->rutina_id;
        $usuario->save();

        return back()->with('success', 'Rutina asignada correctamente');
    }



}
