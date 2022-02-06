<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array
    {
        return [
            "id", 
            "name", 
            "email", 
            "contact number", 
            "department", 
            "email_verified_at", 
            "superadmin", 
            "areamanager", 
            "salesmanager", 
            "salesexecutive", 
            "telecaller", 
            "state", 
            "district", 
            "notification", 
            "password",
            "remember_token",
            "created_at",
            "updated_at"
        ];
    }
    public function collection()
    {
        if (Auth::user()->superadmin==true) {
            return User::all();
        }
        else{
            return User::where('state', Auth::user()->state)->get();
        }
    }

}
