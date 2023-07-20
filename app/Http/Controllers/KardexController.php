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

        return view('kardex.all', ['kardex' => $kardex, 'historia' => $historia, 
            'user' => $patient->user, 'patient_id' => $patient->id
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'historia_id' => ['required', 'exists:historias,id'],
            'titulo' => ['required', 'string', 'max:255'],
            'file' => ['mimes:pdf,png,jpg,jpeg,doc,docx,xls,xlsx,zip,rar', 'max:10240']
        ]);

        $folder = 'tratamientos';

        if ($request->file('file')) {
            $fileName = time().'_'.str_replace('+', '_', $request->file->getClientOriginalName());
            $filePath = $request->file('file')->storeAs($folder, $fileName, 'public');

            Kardex::create([
                'historia_id' => $request->historia_id,
                'tratamiento' => $request->titulo,
                'descripcion' => $request->descripcion,
                'url' => '' . $filePath
            ]);
        }
        else {
            Kardex::create([
                'historia_id' => $request->historia_id,
                'tratamiento' => $request->titulo,
                'descripcion' => $request->descripcion
            ]);
        }

        return back();
    }

    public function detallesStore(Request $request)
    {
        $request->validate([
            'historia_id' => ['required', 'exists:historias,id'],
            'titulo' => ['required', 'string', 'max:255'],
            'file' => ['mimes:pdf,png,jpg,jpeg,doc,docx,xls,xlsx,zip,rar', 'max:10240']
        ]);

        $folder = 'tratamientos';

        if ($request->file('file')) {
            $fileName = time().'_'.str_replace('+', '_', $request->file->getClientOriginalName());
            $filePath = $request->file('file')->storeAs($folder, $fileName, 'public');

            Kardex::create([
                'historia_id' => $request->historia_id,
                'tratamiento' => $request->titulo,
                'descripcion' => $request->descripcion,
                'url' => '' . $filePath
            ]);
        }
        else {
            Kardex::create([
                'historia_id' => $request->historia_id,
                'tratamiento' => $request->titulo,
                'descripcion' => $request->descripcion
            ]);
        }

        return back();
    }
}
