<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelecallerController extends Controller
{
    public function index()
    {
        return view('telecaller.index');
    }
}
