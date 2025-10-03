<?php

namespace App\Http\Controllers;

use App\Models\RutinaEjercicios;
use Illuminate\Http\Request;

class RutinaEjerciciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rutinaEjercicios = RutinaEjercicios::all();
        return view('rutinaEjercicios.index', compact('rutinaEjercicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rutinaEjercicios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        RutinaEjercicios::create($request->all());

        return redirect()->route('rutinaEjercicios.index'); 
        // ->with('success', 'Rutina de ejercicios creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(RutinaEjercicios $rutinaEjercicio)
    {
        return view('rutinaEjercicios.show', compact('rutinaEjercicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rutinaEjercicio = RutinaEjercicios::findOrFail($id);
        return view('rutinaEjercicios.edit', compact('rutinaEjercicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rutinaEjercicio = RutinaEjercicios::findOrFail($id);
        $rutinaEjercicio->update($request->all());

        return redirect()->route('rutinaEjercicios.index'); 
        // ->with('success', 'Rutina de ejercicios actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rutinaEjercicio = RutinaEjercicios::findOrFail($id);
        $rutinaEjercicio->delete();

        return redirect()->route('rutinaEjercicios.index'); 
        // ->with('success', 'Rutina de ejercicios eliminada correctamente');
    }
}
