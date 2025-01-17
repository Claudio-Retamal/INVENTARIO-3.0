<?php

namespace App\Http\Controllers\Prestacion;

use App\Http\Controllers\Controller;
use App\Models\Prestacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PrestacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $equipos = DB::table('equipos')
            ->select('*')
            ->where('estado', '=', 1)->get();

        $personals = DB::table('personals')
            ->select('*')
            ->where('estado', '=', 1)->get();



        return view('prestacion.prestacion', compact('equipos', 'personals'));
    }


    public function store(Request $request)
    {
        $fechas = [
            $request->input('start'),
            $request->input('end')
        ];

        if ($fechas[0] > $fechas[1]) {

            return response()->json([
                'message' => 'error en fechas',
            ]);
        } else {

            $validated = $request->validate([
                'title' => 'required',
                'start' => 'required',
                'end' => 'required',
                'color' => 'required',
                'equipo' => 'required',
                'personal' => 'required',
                'observacion' => 'required'

            ]);

            if ($validated) {
                Prestacion::create([
                    'equipos_id' => $request->input('equipo'),
                    'personals_id' => $request->input('personal'),
                    'start' =>     $request->input('start'),
                    'end'  =>  $request->input('end'),
                    'title' => $request->input('title'),
                    'color' => $request->input('color'),
                    'observacion' =>  $request->input('observacion'),

                ]);

                return response()->json([
                    'message' => 'Datos insertados',
                ]);

                return redirect()->back()->with('success', 'your message,here');
            } else {
                return response()->json([
                    'message' => 'error en validacion de inputs',
                ]);
            }
        }
    }

    public function show()
    {
        //change name dATA IN prestacions - start end - title-
        $prestacion = DB::table('prestacions')
            ->select('*')
            ->get();

        return response()->json($prestacion);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //AGREGAR FILA DE OBSERVACIÓN A LA TABLA PRESTACIONS 
        // $prestacion  = Prestacion::findOrFail($id);3+

        // dd($prestacion);

        $prestacion = DB::table('prestacions')
            ->where('id', $id)
            ->first();
            return response()->json($prestacion);

            // $prestacion->start = Carbon::createFormat('Y-m-s H:i:s', $prestacion->start)->format('Y-m-d');
            // $prestacion->end = Carbon::createFormat('Y-m-s H:i:s', $prestacion->start)->format('Y-m-d');

    }


    public function update(Request $request, string $id)
    {
        
        $prestacion = Prestacion::find($id);

        // Verificar si el usuario existe
        if (!$prestacion) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Actualizar el usuario
        $prestacion->title = $request->input('title');
        $prestacion->start = $request->input('start');
        $prestacion->end = $request->input('end');
        $prestacion->color = $request->input('color');
        $prestacion->observacion = $request->input('observacion');
        $prestacion->personals_id = $request->input('personal');
        $prestacion->equipos_id = $request->input('equipo');

        $prestacion->save();

        // Devolver la respuesta con el usuario actualizado
        return response()->json(['success' => 'Usuario actualizado con éxito', 'prestacion' => $prestacion]);

    }


    public function destroy(string $id)
    {
 
        try {
            // Buscar el item, o lanzar una excepción si no se encuentra
            $prestacion = Prestacion::findOrFail($id);
            
            // Eliminar el item
            $prestacion->delete();
            
            // Responder con éxito
            return response()->json(['success' => 'Item eliminado exitosamente']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Capturar si el item no fue encontrado
            return response()->json(['error' => 'Item no encontrado'], 404);
        } catch (\Exception $e) {
            // Capturar cualquier otro tipo de error
            return response()->json(['error' => 'Hubo un error al intentar eliminar el item. Intenta nuevamente más tarde.'], 500);
        }
    
    }
}
