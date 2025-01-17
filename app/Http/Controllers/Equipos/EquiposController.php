<?php

namespace App\Http\Controllers\Equipos;

use App\Http\Controllers\Controller;
use App\Imports\EquiposImport;
use App\Models\Equipos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $salas = DB::table('salas')
            ->select('*')
            ->where('estado', '=', 1)->get();


        $categorias = DB::table('categorias')
            ->select('*')
            ->where('estado', '=', 1)->get();


        $equipos = DB::table('equipos')
            ->select('*')
            ->where('estado', '=', 1)->get();


        return view('equipos.equipos', compact('equipos', 'categorias', 'salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $equipos = new Equipos();

        $data = $request->all();

        $equipos->create($data);
        return redirect()->back()->with('success', '¡Usuario creado con éxito!');
    }

    public function import(Request $request)
    {


        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new EquiposImport, $file);

        return redirect('Equipos');
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

        $categorias = DB::table('categorias')
            ->select('*')
            ->where('estado', '=', 1)->get();


        $salas = DB::table('salas')
            ->select('*')
            ->where('estado', '=', 1)->get();

        $equipos = Equipos::findOrFail($id);
        return view('Equipos.edit', compact('equipos', 'categorias', 'salas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        
        $equipos = Equipos::findOrFail($id);
        
        $equipos->nombre = $request->nombre;
        $equipos->serial = $request->serial;
        $equipos->modelo = $request->modelo;
        $equipos->color = $request->color;
        $equipos->estado = $request->estado;
        $equipos->salas_id = $request->salas_id;
        $equipos->categorias_id = $request->categorias_id;

        if ($equipos->estado == 1) {
            $equipos->estado = 1;
            $equipos->save();

            $equipos = DB::table('equipos')
                ->select('*')
                ->where('estado', '=', 1)->simplePaginate(5);

                $categorias = DB::table('categorias')
                ->select('*')
                ->where('estado', '=' , 1)
                ->get();

                $salas = DB::table('salas')
                ->select('*')
                ->where('estado', '=' , 1)
                ->get();

            return view('equipos.equipos', compact('equipos','categorias','salas'));
        
        } else {
            $equipos->estado = 0;
            $equipos->save();


            $e6quipos = DB::table('equipos')
            ->select('*')
            ->where('estado', '=', 1)->simplePaginate(5);

            $categorias = DB::table('categorias')
            ->select('*')
            ->where('estado', '=' , 1)
            ->get();

            $salas = DB::table('salas')
            ->select('*')
            ->where('estado', '=' , 1)
            ->get();

            return view('equipos.equipos', compact('categorias','equipos','salas'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
