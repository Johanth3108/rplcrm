<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->superadmin==true) {
            return redirect()->route('admin.home');
        }
        elseif(Auth::user()->areamanager==true){
            return redirect()->route('areamanager.home');
        }
        elseif(Auth::user()->salesmanager==true){
            return redirect()->route('salesmanager.home');
        }
        elseif(Auth::user()->salesexecutive==true){
            return redirect()->route('salesexecutive.home');
        }
        elseif(Auth::user()->telecaller==true){
            return redirect()->route('telecaller.home');
        }
        if (Auth::user()->salesmanager==1){
            // dd('test');
            return view('salesmanager.index');
            // return redirect()->route('salesmanager.home');
        }
        elseif (Auth::user()->salesexecutive==1){
            return view('salesexecutive.index');
        }
        else{
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
