<?php

namespace App\Http\Controllers;

use App\Models\lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesexecutiveController extends Controller
{
    public function index()
    {
        return view('salesexecutive.index');
    }
    public function message()
    {
        return view('salesexecutive.message');
    }
    public function whatsapp()
    {
        return view('salesexecutive.whatsapp');
    }
    public function calender()
    {
        return view('salesexecutive.calender');
    }
    public function leads()
    {
        $leads = lead::where('district', Auth::user()->district)->get();
        return view('salesexecutive.leads', compact('leads'));
    }
    public function assign()
    {
        $telecallers = User::where('telecaller', true)->get();
        $leads = lead::where('district', Auth::user()->district)->get();
        return view('salesexecutive.assign', compact('telecallers','leads'));
    }
}
