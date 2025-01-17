<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Imports\PersonalImport;
use App\Models\Cargo;
use App\Models\Personal;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use function Laravel\Prompts\select;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        /*   $cargos_all = DB::table('cargos')
            ->select('*')
            ->join('personals', 'cargos.id', '=', 'personals.id')
            ->get();
            
            SELECT * 
FROM personals

WHERE

personals.cargos_id = cargos_id

            dd($cargos_all); */




        $cargos_personal =  DB::table('personals')
            ->crossJoin('cargos')
            ->select('cargos.id', 'cargos.nombre')
            ->where('personals.cargos_id', '=', DB::raw('cargos.id'))
            ->get();


        $personals = DB::table('personals')
            ->select('*')
            ->where('estado', '=', 1)->simplePaginate(5);

        $cargos = DB::table('cargos')
            ->select('*')
            ->where('estado', '=', 1)->get();


        return view('personal.personal', compact('personals', 'cargos', 'cargos_personal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'cargo' => 'required'
        ]);

        if (!$validated) {
            return redirect()->back()->with('error', '¡Error al crear el personal!');
        } else {
            Personal::create([
                'nombres'       => $request->input('nombres'),
                'apellidos'   => $request->input('apellidos'),
                'cargos_id' => $request->input('cargo')
            ]);

            return redirect()->back()->with('success', '¡personal creado con éxito!');
        }
    }

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new PersonalImport, $file);

        return redirect('Personal');
    }

    public function edit(string $id)
    {

        $cargos = DB::table('cargos')
            ->select('*')
            ->where('estado', '=', 1)->get();

        $personal =    DB::table('personals')
            ->select('*')
            ->where('personals.id', '=', $id)
            ->get();

     

        return view('personal.edit', compact('personal', 'cargos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $personal = Personal::findOrFail($id);
        $personal->nombres = $request->nombres;
        $personal->apellidos = $request->apellidos;
        $personal->cargo = $request->cargo;
        $personal->estado = $request->estado;

        $personal->save();



        // Redirigir con un mensaje de éxito
        return redirect()->route('Personal')->with('success', 'Datos actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function cargo(Request $request)
    {

        $validated = $request->validate([
            'cargo_nuevo' => 'required',

        ]);

        if (!$validated) {
            return redirect()->back()->with('error', '¡Usuario creado con éxito!');
        } else {
            Cargo::create([
                'nombre' => $request->input('cargo_nuevo')
            ]);

            return redirect()->back()->with('success', '¡Usuario creado con éxito!');
        }
    }
}
