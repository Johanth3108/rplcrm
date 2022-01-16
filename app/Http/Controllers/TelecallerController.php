<?php

namespace App\Http\Controllers;

use App\Models\assign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelecallerController extends Controller
{
    public function index()
    {
        return view('telecaller.index');
    }

    public function profile()
    {
        return view('telecaller.profile');
    }

    public function calender()
    {
        return view('telecaller.calender');
    }

    public function assigned()
    {
        $leads = assign::where('employee_id', Auth::user()->id)->get();
        return view('telecaller.assigned', compact('leads'));
    }
}
