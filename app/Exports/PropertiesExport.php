<?php

namespace App\Exports;

use App\Models\properties;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertiesExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array
    {
        return [
            "id", 
            "property name", 
            "address", 
            "district", 
            "state",
            "property type", 
            "owner", 
            "status", 
            "assigned salesmanager", 
            "assigned salesexecutive", 
            "assigned telecaller", 
            "created_at",
            "updated_at"
        ];
    }
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
