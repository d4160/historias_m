<?php

namespace App\Http\Controllers;

use App\Models\ExamenAuxiliar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class YabajaAPI extends Controller
{
    //
    function getData($id = null)
    {
        return $id ? ExamenAuxiliar::find($id) : ExamenAuxiliar::all();
    }

    function uploadFile(Request $req)
    {
        $result = $req->file('file')->store('documents');
        return ['result' => $result];
    }

    function uploadBin(Request $request)
    {
        // $binaryData = $request->getContent();

        // $uniqueFileName = md5(uniqid(microtime(), true));
        // $fileExtension = substr(strrchr(getimagesizefromstring($binaryData)['mime'], '/'), 1);
        // $fileName = "$uniqueFileName.$fileExtension";

        $storedFile = Storage::disk('public')->put('documents2', $request->getContent());

        return $storedFile;
    }
}
