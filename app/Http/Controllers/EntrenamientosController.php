<?php

namespace App\Http\Controllers;

use App\Models\entrenamientos;
use Illuminate\Http\Request;

class EntrenamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrenamientos = entrenamientos::all();
        return view('entrenamientos.index', compact('entrenamientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entrenamientos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        entrenamientos::create( $request->all());

        return redirect()->route('entrenamientos.index'); //->with('sucess','entrenamiento creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(entrenamientos $entrenamientos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit($id)
{
    $entrenamiento = entrenamientos::findOrFail($id);
    return view('entrenamientos.edit', compact('entrenamiento'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $entrenamientos = entrenamientos::findorFail($id);
        $entrenamientos->update($request->all());

        return redirect()->route('entrenamientos.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $entrenamientos = entrenamientos::findorFail($id);
        $entrenamientos->delete();

        return redirect()->route('entrenamientos.index'); //->with('sucess','entrenamiento eliminado correctamente');
    }
}
