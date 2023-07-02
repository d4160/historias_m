<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\EnfermedadActual;
use Illuminate\Http\Request;

class EnfermedadActualController extends Controller
{
    public function save(Request $request, $id){
        $c = Cita::find($id);
        $ea = $c->enfermedadActual;

        if ($ea){
            $ea->seg_tip_informante = $request->seg_tip_informante;
            $ea->tie_enfermedad = $request->tie_enfermedad;
            $ea->for_inicio = $request->for_inicio;
            $ea->sig_sin_principales = $request->sig_sin_principales;
            $ea->rel_cronologico = $request->rel_cronologico;

            $ea->save();
        }
        else {
            $ea = EnfermedadActual::create([
                'cita_id' => $id,
                'seg_tip_informante' => $request->seg_tip_informante,
                'tie_enfermedad' => $request->tie_enfermedad,
                'for_inicio' => $request->for_inicio,
                'sig_sin_principales' => $request->sig_sin_principales,
                'rel_cronologico' => $request->rel_cronologico
            ]);

            $c->enfermedad_actual_id = $ea->id;
            $c->save();
        }

        return redirect(route('citas.edit', $id));
    }
}
