<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;
use App\Models\Kardex;
use App\Models\KardexDetalle;

class KardexController extends Controller
{
    //
    public function index($historia_id)
    {
        $historia = Historia::find($historia_id);
        $kardex = $historia->kardex;

        if (!$kardex) {
            $kardex = Kardex::create([
                'historia_id' => $historia_id
            ]);

            $historia->kardex_id = $kardex->id;
            $historia->save();
        }
        $patient = $historia->paciente;
        $user = $patient->user;
        if (!$user->procedencia_dep || !$user->procedencia_prov) {
            $user->procedencia_dep = '12';
            $user->procedencia_prov = '1201';
            $user->procedencia_dis = '120101';
            $user->save();
        }

        return view('kardex.all', ['kardex' => $kardex, 'historia' => $historia,
            'user' => $user, 'patient_id' => $patient->id
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        ]);

        $kardex = Kardex::find($id);
        $kardex->observaciones = $request->observaciones;
        $kardex->exam_lab = $request->exam_lab;
        $kardex->exam_imagen = $request->exam_imagen;
        $kardex->reevaluacion = $request->reevaluacion;
        $kardex->save();

        return back();
    }

    public function detalleStore(Request $request, $id)
    {
        $request->validate([
            'medicamento' => ['required', 'string']
        ]);

        KardexDetalle::create([
            'kardex_id' => $id,
            'medicamento' => $request->medicamento,
            'dosis' => $request->dosis,
            'via' => $request->via,
            'frecuencia' => $request->frecuencia,
            'dia1' => $request->dia1,
            'dia2' => $request->dia2,
            'dia3' => $request->dia3,
            'dia4' => $request->dia4,
            'dia5' => $request->dia5,
            'dia6' => $request->dia6,
            'dia7' => $request->dia7,
            'dia8' => $request->dia8,
            'fecha' => $request->fecha
        ]);

        return back();
    }

    public function detalleUpdate(Request $request, $id)
    {
        $request->validate([
            'medicamento' => ['required', 'string']
        ]);

        $det = KardexDetalle::find($id);
        $det->medicamento = $request->medicamento;
        $det->dosis = $request->dosis;
        $det->via = $request->via;
        $det->frecuencia = $request->frecuencia;
        $det->dia1 = $request->dia1;
        $det->dia2 = $request->dia2;
        $det->dia3 = $request->dia3;
        $det->dia4 = $request->dia4;
        $det->dia5 = $request->dia5;
        $det->dia6 = $request->dia6;
        $det->dia7 = $request->dia7;
        $det->dia8 = $request->dia8;
        $det->fecha = $request->fecha;

        $det->save();

        return back();
    }

    public function detalleDestroy($id)
    {
        $result = KardexDetalle::findOrFail($id);

        $result->delete();

        return back();
    }

    public function print($id)
    {
        $kardex = Kardex::find($id);

        return view('kardex.print', [
            'kardex' => $kardex,
            'historia' => $kardex->historia,
            'user' => $kardex->historia->paciente->user,
            'detalles' => $kardex->detalles
        ]);
    }
}
