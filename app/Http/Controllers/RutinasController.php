<?php

namespace App\Http\Controllers;

use App\Http\Requests\RutinaRequest;
use App\Models\entrenamientos;
use App\Models\rutinas;
use Illuminate\Http\Request;

class RutinasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rutinas = rutinas::all();

        return view('rutinas.index', compact('rutinas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entrenamientos = entrenamientos::all();
        return view('rutinas.create', compact('entrenamientos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RutinaRequest $request)
    {
        rutinas::create( $request->all());

        return redirect()->route('rutinas.index')->with('success', 'rutinas creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(rutinas $rutinas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rutinas = rutinas::FindorFail($id);
        $entrenamientos = entrenamientos::all();

        return view('rutinas.edit', compact('rutinas', 'entrenamientos'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $rutinas = rutinas::FindorFail($id);
        $rutinas->update($request->all());

        return redirect()->route('rutinas.index')->with('success','rutinas actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */

 
    public function destroy( $id)
    {
    {
        
        $rutina = rutinas::FindorFail($id);
        try{
        $rutina -> delete();
        return redirect()->route('rutinas.index')
        ->with('success', 'rutina eliminado correctamente.');
       }  catch (\Illuminate\Database\QueryException $e) {
        return redirect()->route('rutinas.index')
                ->with('error', 'No se puede eliminar esta rutina porque tiene  entrenamientos asociadas.');
        }
    }
    }
}