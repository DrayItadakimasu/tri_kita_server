<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class privateFilesController extends Controller
{
    //Загрузка файлов

    public function getFile($user_id, $type, $file_id)
    {

        $path = 'app/private/' . $type . '/' . $file_id;
        if (file(storage_path($path))) {
            return response()->file(storage_path($path));
        }

        die(404);
    }
}
