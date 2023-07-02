<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Diagnostico;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    public function saveP(Request $request, $id){
        $c = Cita::find($id);
        $d = $c->diagnostico;

        if ($d){
            $d->dia_pre_cei101 = $request->dia_pre_cei101;
            $d->dia_pre_p1 = $request->dia_pre_p1;
            $d->dia_pre_cei102 = $request->dia_pre_cei102;
            $d->dia_pre_p2 = $request->dia_pre_p2;
            $d->dia_pre_cei103 = $request->dia_pre_cei103;
            $d->dia_pre_p3 = $request->dia_pre_p3;

            $d->save();
        }
        else {
            $d = Diagnostico::create([
                'cita_id' => $id,
                'dia_pre_cei101' => $request->dia_pre_cei101,
                'dia_pre_p1' => $request->dia_pre_p1,
                'dia_pre_cei102' => $request->dia_pre_cei102,
                'dia_pre_p2' => $request->dia_pre_p2,
                'dia_pre_cei103' => $request->dia_pre_cei103,
                'dia_pre_p3' => $request->dia_pre_p3
            ]);

            $c->diagnostico_id = $d->id;
            $c->save();
        }

        return redirect(route('citas.edit', $id));
    }

    public function saveD(Request $request, $id){
        $c = Cita::find($id);
        $d = $c->diagnostico;

        if ($d){
            $d->dia_def_cie10 = $request->dia_def_cie10;
            $d->dia_def_d = $request->dia_def_d;

            $d->save();
        }
        else {
            $d = Diagnostico::create([
                'cita_id' => $id,
                'dia_def_cie10' => $request->dia_def_cie10,
                'dia_def_d' => $request->dia_def_d,
            ]);

            $c->diagnostico_id = $d->id;
            $c->save();
        }

        return redirect(route('citas.edit', $id));
    }
}
