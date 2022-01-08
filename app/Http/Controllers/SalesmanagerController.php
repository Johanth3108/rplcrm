<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesmanagerController extends Controller
{
    public function index()
    {
        dd('test');
        return view('salesmanager.index');
    }
}
