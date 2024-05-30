<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supir;

class supirdata extends Controller
{
    public function home () {

        $supirs = Supir::get();
        return view('supir.index', compact('supirs'));

    }

    
}
