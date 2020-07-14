<?php

namespace App\Http\Controllers\lk;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\saveText;

class SaveTextController extends Controller
{
    public function save(SaveTextController $SaveTextController, $text)
    {

        $SaveTextController->save_info_text = $text;
        $SaveTextController->save();

    }
}
