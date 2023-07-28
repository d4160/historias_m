<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Examen;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    public function save(Request $request, $id){
        $c = Cita::find($id);
        $e = $c->examen;

        if ($e){
            $e->exa_fis_est_general = $request->exa_fis_est_general;
            $e->exa_fis_est_conciencia = $request->exa_fis_est_conciencia;
            $e->exa_fis_dirigido = $request->exa_fis_dirigido;

            $e->save();
        }
        else {
            $e = Examen::create([
                'cita_id' => $id,
                'exa_fis_est_general' => $request->exa_fis_est_general,
                'exa_fis_est_conciencia' => $request->exa_fis_est_conciencia,
                'exa_fis_dirigido' => $request->exa_fis_dirigido
            ]);

            $c->examen_id = $e->id;
            $c->save();
        }

        return redirect(route('historias.edit', $id));
    }
}
