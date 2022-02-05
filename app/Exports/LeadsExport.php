<?php

namespace App\Exports;

use App\Models\lead;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array
    {
        return [
            "id", 
            "client name", 
            "client phone", 
            "client email", 
            "property name", 
            "address", 
            "location", 
            "state", 
            "district", 
            "property type", 
            "lead from", 
            "assigned man", 
            "assigned exe", 
            "assigned tele", 
            "status",
            "feedback",
            "created_at",
            "updated_at"
        ];
    }
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
