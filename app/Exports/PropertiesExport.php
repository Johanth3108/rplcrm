<?php

namespace App\Exports;

use App\Models\properties;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class PropertiesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->superadmin==true) {
            return properties::all();
        }
        else{
            return properties::where('state', Auth::user()->state)->get();
        }
    }
}
