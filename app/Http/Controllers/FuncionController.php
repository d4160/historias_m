<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Funcion;
use Illuminate\Http\Request;

class FuncionController extends Controller
{
    public function saveFunBiologicas(Request $request, $id){
        $c = Cita::find($id);
        $f = $c->funcion;

        if ($f){
            $f->fun_bio_apetito = $request->fun_bio_apetito;
            $f->fun_bio_sed = $request->fun_bio_sed;
            $f->fun_bio_sueno = $request->fun_bio_sueno;
            $f->fun_bio_orina = $request->fun_bio_orina;
            $f->fun_bio_deposiciones = $request->fun_bio_deposiciones;

            $f->save();
        }
        else {
            $f = Funcion::create([
                'cita_id' => $id,
                'fun_bio_apetito' => $request->fun_bio_apetito,
                'fun_bio_sed' => $request->fun_bio_sed,
                'fun_bio_sueno' => $request->fun_bio_sueno,
                'fun_bio_orina' => $request->fun_bio_orina,
                'fun_bio_deposiciones' => $request->fun_bio_deposiciones
            ]);

            $c->funcion_id = $f->id;
            $c->save();
        }

        return redirect(route('historias.edit', $id));
    }

    public function saveFunVitales(Request $request, $id){
        $c = Cita::find($id);
        $f = $c->funcion;

        if ($f){
            $f->fun_vit_pa = $request->fun_vit_pa;
            $f->fun_vit_fr = $request->fun_vit_fr;
            $f->fun_vit_fc = $request->fun_vit_fc;
            $f->fun_vit_t = $request->fun_vit_t;
            $f->fun_vit_peso = $request->fun_vit_peso;
            $f->fun_vit_talla = $request->fun_vit_talla;
            $f->fun_vit_imc = $request->fun_vit_imc;

            $f->save();
        }
        else {
            $f = Funcion::create([
                'cita_id' => $id,
                'fun_vit_pa' => $request->fun_vit_pa,
                'fun_vit_fr' => $request->fun_vit_fr,
                'fun_vit_fc' => $request->fun_vit_fc,
                'fun_vit_t' => $request->fun_vit_t,
                'fun_vit_peso' => $request->fun_vit_peso,
                'fun_vit_talla' => $request->fun_vit_talla,
                'fun_vit_imc' => $request->fun_vit_imc
            ]);

            $c->funcion_id = $f->id;
            $c->save();
        }

        return redirect(route('historias.edit', $id));
    }
}
