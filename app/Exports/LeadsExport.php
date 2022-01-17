<?php

namespace App\Exports;

use App\Models\lead;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeadsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->superadmin==true) {
            return lead::all();
        }
        else{
            return lead::where('state', Auth::user()->state)->get();
        }
    }
}
