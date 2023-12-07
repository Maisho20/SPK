<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VikorController extends Controller
{
    public function table(Request $request)
    {
        $x = $request->input('x');
        $y = $request->input('y');

        return view('table')->with(['x' => $x, 'y' => $y]);
    }
}
