<?php

namespace App\Http\Controllers;

use App\Models\PlanNutricional;
use App\Models\Usuario;
use App\Models\rutinas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class UsuarioController extends Controller
{

    /**
     * LISTAR USUARIOS
     */
    public function index()
    {
        $usuarios = Usuario::all();

        return view('usuarios.index', compact('usuarios'));
    }


    /**
     * FORM CREAR
     */
    public function create()
    {
        return view('usuarios.create');
    }


    /**
     * GUARDAR USUARIO
     */
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email|unique:usuarios,email',
        'password' => 'required|min:8',
        'fechaRegistro' => 'required|date',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('imagenes/perfiles', 'public');
    }

    Usuario::create([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'password' => $request->password,
        'fechaRegistro' => $request->fechaRegistro,
        'foto' => $fotoPath,
    ]);

    return redirect()
        ->route('usuario.index')
        ->with('success', 'Usuario creado correctamente');
}


    /**
     * PERFIL USUARIO
     */
    public function show($id)
    {

        $usuario = Usuario::findOrFail($id);

        // Última valoración
        $ultimaValoracion = $usuario->valoraciones()
            ->orderBy('created_at', 'desc')
            ->first();

        // Plan nutricional activo
        $planNutricional = PlanNutricional::where('id_usuario', $id)
            ->where('activo', true)
            ->first();

        $historialValoraciones = $usuario->historialValoraciones()
            ->latest('fecha_historial')
            ->take(5)
            ->get();

        $rutinasUsuario = rutinas::whereHas('entrenamiento.valoracion', function ($query) use ($id) {
            $query->where('idUsuario', $id);
        })->with('entrenamiento')->get();

        return view('usuarios.perfil', compact(
            'usuario',
            'ultimaValoracion',
            'planNutricional',
            'historialValoraciones',
            'rutinasUsuario'
        ));
    }


    /**
     * FORM EDITAR
     */
    public function edit($id)
    {

        $usuario = Usuario::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));

    }


    /**
     * ACTUALIZAR USUARIO
     */
    public function update(Request $request, $id)
    {

        $usuario = Usuario::findOrFail($id);

        $request->validate([

            'nombre' => 'required|string|max:255',

            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,

            'password' => 'nullable|min:8|confirmed',

            'fechaRegistro' => 'required|date',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $usuario->nombre = $request->nombre;

        $usuario->email = $request->email;

        $usuario->fechaRegistro = $request->fechaRegistro;

        if ($request->hasFile('foto')) {
            if ($usuario->foto) {
                Storage::disk('public')->delete($usuario->foto);
            }
            $usuario->foto = $request->file('foto')->store('imagenes/perfiles', 'public');
        }

        // SOLO ACTUALIZA PASSWORD SI SE ESCRIBE
        if ($request->filled('password')) {

            $usuario->password = $request->password;

        }

        $usuario->save();

        return redirect()
            ->route('usuario.index')
            ->with('success', 'Usuario actualizado correctamente');

    }


    /**
     * ELIMINAR USUARIO
     */
    public function destroy($id)
    {

        $usuario = Usuario::findOrFail($id);

        try {

            if ($usuario->foto) {
                Storage::disk('public')->delete($usuario->foto);
            }

            $usuario->delete();

            return redirect()
                ->route('usuario.index')
                ->with('success', 'Usuario eliminado correctamente');

        } catch (QueryException $e) {

            return redirect()
                ->route('usuario.index')
                ->with('error', 'No se puede eliminar porque tiene registros asociados');

        }

    }


    public function reportePdf($id)
    {
        $usuario = Usuario::findOrFail($id);

        $ultimaValoracion = $usuario->valoraciones()
            ->orderBy('created_at', 'desc')
            ->first();

        $planNutricional = PlanNutricional::where('id_usuario', $id)
            ->where('activo', true)
            ->first();

        $historialValoraciones = $usuario->historialValoraciones()
            ->latest('fecha_historial')
            ->take(5)
            ->get();

        $rutinasUsuario = rutinas::whereHas('entrenamiento.valoracion', function ($query) use ($id) {
            $query->where('idUsuario', $id);
        })->with('entrenamiento')->get();

        $pdf = Pdf::loadView('usuarios.reporte', compact('usuario', 'ultimaValoracion', 'planNutricional', 'historialValoraciones', 'rutinasUsuario'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('FitBoost-Reporte-Usuario-' . $usuario->id . '.pdf');
    }


    /**
     * SUBIR FOTO PERFIL
     */
    public function subirFoto(Request $request, $id)
    {

        $request->validate([

            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $usuario = Usuario::findOrFail($id);

        if ($usuario->foto) {
            Storage::disk('public')->delete($usuario->foto);
        }

        $usuario->foto = $request->file('foto')->store('imagenes/perfiles', 'public');

        $usuario->save();

        return back()->with(
            'success',
            'Foto actualizada correctamente'
        );

    }

}