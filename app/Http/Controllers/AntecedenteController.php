<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antecedente;
use App\Models\Paciente;

class AntecedenteController extends Controller
{
    //
    public function save(Request $request, $id){
        $p = Paciente::find($id);
        $a = $p->antecedente;

        if ($a){
            $a->fis_prenatales = $request->fis_prenatales;
            $a->fis_natal = $request->fis_natal;
            $a->fis_inmunizaciones = $request->fis_inmunizaciones;
            $a->gen_medicamentos = $request->gen_medicamentos;
            $a->hab_noc_tabaco = $request->hab_noc_tabaco;
            $a->hab_noc_oh = $request->hab_noc_oh;
            $a->hab_noc_drogas = $request->hab_noc_drogas;
            $a->hab_noc_cafe = $request->hab_noc_cafe;
            $a->hab_noc_otros = $request->hab_noc_otros;
            $a->gin_obs_menarquia = $request->gin_obs_menarquia;
            $a->gin_obs_rc = $request->gin_obs_rc;
            $a->gin_obs_fur = $request->gin_obs_fur;
            //$a->gin_obs_fpp = $request->gin_obs_fpp;
            //$a->gin_obs_rs = $request->gin_obs_rs;
            $a->gin_obs_dismenorrea = $request->gin_obs_dismenorrea;
            $a->gin_obs_g = $request->gin_obs_g;
            $a->gin_obs_p = $request->gin_obs_p;
            //$a->gin_obs_fup = $request->gin_obs_fup;
            $a->gin_obs_cesareas = $request->gin_obs_cesareas;
            $a->gin_obs_ult_pap = $request->gin_obs_ult_pap;
            $a->gin_obs_mamografia = $request->gin_obs_mamografia;
            $a->gin_obs_mac = $request->gin_obs_mac;
            $a->cirugias = $request->cirugias;
            $a->gin_obs_otros = $request->gin_obs_otros;
            $a->hepatitis = $request->hepatitis;
            $a->sd_febril = $request->sd_febril;
            $a->alergias = $request->alergias;
            $a->tuberculosis = $request->tuberculosis;
            //$a->cirugias = $request->cirugias;
            $a->hip_arterial = $request->hip_arterial;
            $a->patologicos = $request->patologicos;
            $a->familiares = $request->familiares;
            $a->ocupacionales = $request->ocupacionales;
            $a->ram = $request->ram;
            $a->ram_descripcion = $request->ram_descripcion;

            $a->save();
        }
        else {
            $a = Antecedente::create([
                'paciente_id' => $id,
                'fis_prenatales' => $request->fis_prenatales,
                'fis_prenatales' => $request->fis_prenatales,
                'fis_natal' => $request->fis_natal,
                'fis_inmunizaciones' => $request->fis_inmunizaciones,
                'gen_medicamentos' => $request->gen_medicamentos,
                'hab_noc_tabaco' => $request->hab_noc_tabaco,
                'hab_noc_oh' => $request->hab_noc_oh,
                'hab_noc_drogas' => $request->hab_noc_drogas,
                'hab_noc_cafe' => $request->hab_noc_cafe,
                'hab_noc_otros' => $request->hab_noc_otros,
                'gin_obs_menarquia' => $request->gin_obs_menarquia,
                'gin_obs_rc' => $request->gin_obs_rc,
                'gin_obs_fur' => $request->gin_obs_fur,
                //'gin_obs_fpp' => $request->gin_obs_fpp,
                //'gin_obs_rs' => $request->gin_obs_rs,
                'gin_obs_dismenorrea' => $request->gin_obs_dismenorrea,
                'gin_obs_g' => $request->gin_obs_g,
                'gin_obs_p' => $request->gin_obs_p,
                //'gin_obs_fup' => $request->gin_obs_fup,
                'gin_obs_cesareas' => $request->gin_obs_cesareas,
                'gin_obs_ult_pap' => $request->gin_obs_ult_pap,
                'gin_obs_mamografia' => $request->gin_obs_mamografia,
                'gin_obs_mac' => $request->gin_obs_mac,
                'cirugias' => $request->cirugias,
                'gin_obs_otros' => $request->gin_obs_otros,
                'hepatitis' => $request->hepatitis,
                'sd_febril' => $request->sd_febril,
                'alergias' => $request->alergias,
                'tuberculosis' => $request->tuberculosis,
                // 'cirugias' => $request->cirugias,
                'hip_arterial' => $request->hip_arterial,
                'patologicos' => $request->patologicos,
                'familiares' => $request->familiares,
                'ocupacionales' => $request->ocupacionales,
                'ram' => $request->ram,
                'ram_descripcion' => $request->ram_descripcion
            ]);

            $p->antecedente_id = $a->id;
            $p->save();
        }

        return redirect(route('patients.edit', $id));
    }
}
