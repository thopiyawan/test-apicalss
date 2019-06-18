<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hospital;

class HospitalController extends Controller
{
    public function hospitals()
    {
        $hospital = Hospital::all();
        return response()->json($hospital);
    }
}
