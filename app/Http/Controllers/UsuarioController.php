<?php

namespace App\Http\Controllers;

use App\Models\PlanNutricional;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    ]);

    Usuario::create([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'password' => $request->password,
        'fechaRegistro' => $request->fechaRegistro,
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

        return view('usuarios.perfil', compact(
            'usuario',
            'ultimaValoracion',
            'planNutricional'
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

        ]);

        $usuario->nombre = $request->nombre;

        $usuario->email = $request->email;

        $usuario->fechaRegistro = $request->fechaRegistro;

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


    /**
     * SUBIR FOTO PERFIL
     */
    public function subirFoto(Request $request, $id)
    {

        $request->validate([

            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $usuario = Usuario::findOrFail($id);

        $nombre = time() . '.' . $request->foto->extension();

        $request->foto->storeAs(
            'public/imagenes/perfiles',
            $nombre
        );

        $usuario->foto = $nombre;

        $usuario->save();

        return back()->with(
            'success',
            'Foto actualizada correctamente'
        );

    }

}