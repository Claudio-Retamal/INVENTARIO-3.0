<?php

namespace App\Http\Controllers\Sala;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class SalasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $personals = DB::table('personals')
            ->select('*')
            ->where('estado', '=', 1)->get();

          $salas_relacion  =  DB::table('salas')
            ->select('salas.id', 'salas.nombre', 'personals.id', 'personals.nombres')
            ->join('personals','salas.personals_id','=','personals.id')
            ->get();

        $salas = DB::table('salas')
            ->select('*')
            ->where('estado', '=', 1)->get();


        return view('salas.salas', compact('salas', 'personals','salas_relacion'));
    }


    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nombre' => 'required',
            'tipo_sala' => 'required',
            'personal' => 'required',
        ]);

        if (!$validated) {
            alert('ffff');
            return redirect()->back()->with('error', '¡Sala creado con éxito!');
        } else {
            Sala::create([
                'nombre'       => $request->input('nombre'),
                'tipo_sala'   => $request->input('tipo_sala'),
                'personals_id'   => $request->input('personal'),
            ]);

            return redirect()->back()->with('success', '¡Sala creado con éxito!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $salas = Sala::findOrFail($id);

        $personals = DB::table('personals')
        ->select('*')
        ->where('estado', '=', 1)->get();

        return view('salas.edit', compact('salas','personals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
