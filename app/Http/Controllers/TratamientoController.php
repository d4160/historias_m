<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Tratamiento;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    public function save(Request $request, $id){
        $c = Cita::find($id);
        $t = $c->tratamiento;

        if ($t){
            $t->tra_med_hig_dieteticas = $request->tra_med_hig_dieteticas;
            $t->tra_med_preventivos = $request->tra_med_preventivos;
            $t->tra_trans_lugar = $request->tra_trans_lugar;
            $t->tra_trans_hora = $request->tra_trans_hora;
            $t->tra_des_med_periodo = $request->tra_des_med_periodo;
            $t->tra_des_med_dias = $request->tra_des_med_dias;
            $t->tra_fec_pro_cita = $request->tra_fec_pro_cita;

            $t->save();
        }
        else {
            $t = Tratamiento::create([
                'cita_id' => $id,
                'tra_med_hig_dieteticas' => $request->tra_med_hig_dieteticas,
                'tra_med_preventivos' => $request->tra_med_preventivos,
                'tra_trans_lugar' => $request->tra_trans_lugar,
                'tra_trans_hora' => $request->tra_trans_hora,
                'tra_des_med_periodo' => $request->tra_des_med_periodo,
                'tra_des_med_dias' => $request->tra_des_med_dias,
                'tra_fec_pro_cita' => $request->tra_fec_pro_cita
            ]);

            $c->tratamiento_id = $t->id;
            $c->save();
        }

        return redirect(route('citas.edit', $id));
    }
}
