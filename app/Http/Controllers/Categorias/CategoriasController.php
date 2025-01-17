<?php

namespace App\Http\Controllers\Categorias;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoriaImport;



use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorias = DB::table('categorias')
            ->select('*')->simplePaginate(5);
            
        return view('categorias.categorias', compact('categorias'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new CategoriaImport, $file);

        return redirect('Categorias');
    }

    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        if (!$validated) {
            return redirect()->back()->with('error', '¡Usuario creado con éxito!');
        } else {
            Categorias::create([
                'nombre'       => $request->input('nombre'),
                'descripcion'   => $request->input('descripcion'),
            ]);

            return redirect()->back()->with('success', '¡Usuario creado con éxito!');
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
        $categorias = Categorias::findOrFail($id);
      
        return view('categorias.edit', compact('categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        $categorias = Categorias::findOrFail($id);
        $categorias->nombre = $request->nombre;
        $categorias->descripcion = $request->descripcion;
        $categorias->estado = $request->estado;

        if ($categorias->estado == 1) {
            $categorias->estado = 1;
            $categorias->save();
            return redirect('Categorias');

        } else {
            $categorias->estado = 0;
            $categorias->save();
            return redirect('Categorias');
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
