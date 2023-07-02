<?php

namespace App\Http\Controllers;

use App\Models\ExamenAuxiliar;
use App\Models\Historia;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ExamenAuxiliarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($historia_id)
    {
        $historia = Historia::find($historia_id);
        $patient = $historia->paciente;
        $examenesAuxiliares = $historia->examenesAuxiliares;

        return view('examen_auxiliares.all', ['historia' => $historia, 
            'patient' => $patient->user, 'patient_id' => $patient->id
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'historia_id' => ['required', 'exists:historias,id'],
            'titulo' => ['required', 'string', 'max:255'],
            'file' => ['mimes:pdf,png,jpg,jpeg,doc,docx,xls,xlsx,zip,rar', 'max:10240']
        ]);

        $folder = 'examenes_auxiliares';

        if ($request->file('file')) {
            $fileName = time().'_'.str_replace('+', '_', $request->file->getClientOriginalName());
            $filePath = $request->file('file')->storeAs($folder, $fileName, 'public');

            ExamenAuxiliar::create([
                'historia_id' => $request->historia_id,
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'url' => '' . $filePath
            ]);
        }
        else {
            ExamenAuxiliar::create([
                'historia_id' => $request->historia_id,
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion
            ]);
        }

        return back();
    }

    public function update(Request $request, $id)
    {
        // dd($request);

        $request->validate([
            'lab_edit_titulo' => ['required', 'string', 'max:255'],
            'lab_edit_file' => ['mimes:pdf,png,jpg,jpeg,doc,docx', 'max:2048']
        ]);

        $folder = '';

        $exam_aux = ExamenAuxiliar::find($id);

        switch($exam_aux->tipo) {
            case 1:
                $folder = 'examenes_auxiliares/laboratorios';
                break;
            case 2:
                $folder = 'examenes_auxiliares/imagenes';
                break;
            case 3:
                $folder = 'examenes_auxiliares/otros';
                break;
            case 4:
                $folder = 'examenes_auxiliares/procedimientos';
                break;
            case 5:
                $folder = 'examenes_auxiliares/interconsultas';
                break;
        }

        if ($request->file('lab_edit_file')) {

            //dd($request->file('lab_edit_file'));

            if(File::exists(public_path('storage/' . $exam_aux->url))) {
                File::delete(public_path('storage/' . $exam_aux->url));
            }
            else {
                //dd('File does not exists: ' . 'storage/' . public_path($exam_aux->url));
            }

            $fileName = time().'_'.str_replace('+', '_', $request->lab_edit_file->getClientOriginalName());
            $filePath = $request->file('lab_edit_file')->storeAs($folder, $fileName, 'public');

            $exam_aux->url = '' . $filePath;
        }
        else if ($request->file('lab_edit_file2')) {
            $fileName = time().'_'.str_replace('+', '_', $request->lab_edit_file2->getClientOriginalName());
            $filePath = $request->file('lab_edit_file2')->storeAs($folder, $fileName, 'public');

            $exam_aux->url = '' . $filePath;
        }

        $exam_aux->titulo = $request->lab_edit_titulo;
        $exam_aux->descripcion = $request->lab_edit_descripcion;
        $exam_aux->save();

        return back();
    }

    public function destroy($id)
    {
        $result = ExamenAuxiliar::findOrFail($id);

        if(File::exists(public_path('storage/' . $result->url))) {
            File::delete(public_path('storage/' . $result->url));
        }
        else {
            // dd('File does not exists.' . 'storage/' . public_path($result->url));
        }

        $result->delete();

        return back();
    }
}
