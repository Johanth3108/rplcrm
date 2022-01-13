<?php

namespace App\Http\Controllers;

use App\Models\assign;
use Illuminate\Http\Request;

class TelecallerController extends Controller
{
    public function index()
    {
        return view('telecaller.index');
    }

    public function calender()
    {
        return view('telecaller.calender');
    }

    public function assigned()
    {
        $leads = assign::all();
        return view('telecaller.assigned', compact('leads'));
    }
}
