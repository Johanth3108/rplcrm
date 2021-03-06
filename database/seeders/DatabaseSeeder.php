<?php

namespace Database\Seeders;

use App\Models\areamanpage;
use App\Models\assign;
use App\Models\exepage;
use App\Models\lead;
use App\Models\manpage;
use App\Models\proptype;
use App\Models\status;
use App\Models\telepage;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('Seeding Users from DeveloperAccess file...');
        $user = User::where('name', 'Test Super admin')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test Superadmin';
            $user->email = 'superadmin@test.com';
            $user->contact_number = '123456789';
            $user->department = 'sales';
            $user->superadmin = 1;
            $user->salesmanager = null;
            $user->salesexecutive = null;
            $user->telecaller = null;
            $user->state = 'Tamil Nadu';
            $user->district = 'Chennai';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: Superadmin created.");
        }
        $user = User::where('name', 'Test Area Manager')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test Area Manager';
            $user->email = 'areamanager@test.com';
            $user->contact_number = '123456789';
            $user->department = 'sales';
            $user->superadmin = null;
            $user->areamanager = 1;
            $user->salesmanager = null;
            $user->salesexecutive = null;
            $user->telecaller = null;
            $user->state = 'Tamil Nadu';
            $user->district = 'Chennai';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: Area manager created.");
        }
        $user = User::where('name', 'Test salesmanager')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test salesmanager';
            $user->email = 'salesmanager@test.com';
            $user->contact_number = '123456789';
            $user->department = 'sales';
            $user->superadmin = null;
            $user->salesmanager = 1;
            $user->salesexecutive = null;
            $user->telecaller = null;
            $user->state = 'Uttarakhand';
            $user->district = 'Pithoragarh';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: salesmanager created.");
        }
        $user = User::where('name', 'Test salesmanager 1')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test salesmanager 1';
            $user->email = 'salesmanager1@test.com';
            $user->contact_number = '123456789';
            $user->department = 'sales';
            $user->superadmin = null;
            $user->salesmanager = 1;
            $user->salesexecutive = null;
            $user->telecaller = null;
            $user->state = 'Uttarakhand';
            $user->district = 'Chamoli';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: salesmanager 1 created.");
        }
        $user = User::where('name', 'Test salesmanager 2')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test salesmanager 2';
            $user->email = 'salesmanager2@test.com';
            $user->contact_number = '123456789';
            $user->department = 'sales';
            $user->superadmin = null;
            $user->salesmanager = 1;
            $user->salesexecutive = null;
            $user->telecaller = null;
            $user->state = 'Uttarakhand';
            $user->district = 'Haridwar';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: salesmanager 2 created.");
        }
        $user = User::where('name', 'Test salesexecutive')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test salesexecutive';
            $user->email = 'salesexecutive@test.com';
            $user->contact_number = '123456789';
            $user->department = 'sales';
            $user->superadmin = null;
            $user->salesmanager = null;
            $user->salesexecutive = 1;
            $user->telecaller = null;
            $user->state = 'Uttarakhand';
            $user->district = 'Pithoragarh';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: salesexecutive created.");
        }
        $user = User::where('name', 'Test salesexecutive 1')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test salesexecutive 1';
            $user->email = 'salesexecutive1@test.com';
            $user->contact_number = '123456789';
            $user->department = 'sales';
            $user->superadmin = null;
            $user->salesmanager = null;
            $user->salesexecutive = 1;
            $user->telecaller = null;
            $user->state = 'Uttarakhand';
            $user->district = 'Haridwar';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: salesexecutive 1 created.");
        }
        $user = User::where('name', 'Test salesexecutive 2')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test salesexecutive 2';
            $user->email = 'salesexecutive2@test.com';
            $user->contact_number = '123456789';
            $user->department = 'sales';
            $user->superadmin = null;
            $user->salesmanager = null;
            $user->salesexecutive = 1;
            $user->telecaller = null;
            $user->state = 'Uttarakhand';
            $user->district = 'Haridwar';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: salesexecutive 2 created.");
        }
        $user = User::where('name', 'Test telecaller')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test telecaller';
            $user->email = 'telecaller@test.com';
            $user->contact_number = '123456789';
            $user->department = 'telecaller';
            $user->superadmin = null;
            $user->salesmanager = null;
            $user->salesexecutive = null;
            $user->telecaller = 1;
            $user->state = 'WestBengal';
            $user->district = 'Darjeeling';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: telecaller created.");
        }

        $user = User::where('name', 'Test telecaller 1')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test telecaller 1';
            $user->email = 'telecaller1@test.com';
            $user->contact_number = '123456789';
            $user->department = 'telecaller';
            $user->superadmin = null;
            $user->salesmanager = null;
            $user->salesexecutive = null;
            $user->telecaller = 1;
            $user->state = 'WestBengal';
            $user->district = 'Darjeeling';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: telecaller created.");
        }

        $user = User::where('name', 'Test telecaller 2')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Test telecaller 2';
            $user->email = 'telecaller2@test.com';
            $user->contact_number = '123456789';
            $user->department = 'telecaller';
            $user->superadmin = null;
            $user->salesmanager = null;
            $user->salesexecutive = null;
            $user->telecaller = 1;
            $user->state = 'WestBengal';
            $user->district = 'Darjeeling';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: telecaller created.");
        }

        // $lead = lead::where('property_name', 'abc')->first();
        // if(!$lead){
        //     $lead = new lead();
        //     $lead->property_name = 'abc';
        //     $lead->location = 'India';
        //     $lead->state = 'Tamil Nadu';
        //     $lead->district = 'Chennai';
        //     $lead->prop_type = '2BHK';
        //     $lead->lead_from = 'housing.com';
        //     $lead->status = 1;
        //     $lead->save();
        //     $this->command->info("lead 1 created");
        // }

        // $lead = lead::where('property_name', 'cde')->first();
        // if(!$lead){
        //     $lead = new lead();
        //     $lead->property_name = 'cde';
        //     $lead->location = 'India';
        //     $lead->state = 'Tamil Nadu';
        //     $lead->district = 'Chennai';
        //     $lead->prop_type = '2BHK';
        //     $lead->lead_from = 'housing.com';
        //     $lead->status = 2;
        //     $lead->save();
        //     $this->command->info("lead 2 created");
        // }

        // $lead = lead::where('property_name', 'efg')->first();
        // if(!$lead){
        //     $lead = new lead();
        //     $lead->property_name = 'efg';
        //     $lead->location = 'India';
        //     $lead->state = 'Tamil Nadu';
        //     $lead->district = 'Coimbatore';
        //     $lead->prop_type = '2BHK';
        //     $lead->lead_from = '99acres.com';
        //     $lead->status = 3;
        //     $lead->save();
        //     $this->command->info("lead 3 created");
        // }

        // $lead = lead::where('property_name', 'hij')->first();
        // if(!$lead){
        //     $lead = new lead();
        //     $lead->property_name = 'hij';
        //     $lead->location = 'India';
        //     $lead->state = 'Gujarat';
        //     $lead->district = 'Amreli';
        //     $lead->prop_type = '2BHK';
        //     $lead->lead_from = 'housing.com';
        //     $lead->status = 3;
        //     $lead->save();
        //     $this->command->info("lead 4 created Gujarat");
        // }

        // $lead = lead::where('property_name', 'klm')->first();
        // if(!$lead){
        //     $lead = new lead();
        //     $lead->property_name = 'klm';
        //     $lead->location = 'India';
        //     $lead->state = 'Gujarat';
        //     $lead->district = 'Aravalli';
        //     $lead->prop_type = '2BHK';
        //     $lead->lead_from = 'housing.com';
        //     $lead->status = 2;
        //     $lead->save();
        //     $this->command->info("lead 5 created Gujarat");
        // }

        // $lead = lead::where('property_name', 'nop')->first();
        // if(!$lead){
        //     $lead = new lead();
        //     $lead->property_name = 'nop';
        //     $lead->location = 'India';
        //     $lead->state = 'Gujarat';
        //     $lead->district = 'Bhavnagar';
        //     $lead->prop_type = '2BHK';
        //     $lead->lead_from = '99acres.com';
        //     $lead->status = 1;
        //     $lead->save();
        //     $this->command->info("lead 6 created Gujarat");
        // }

        // $lead = lead::where('property_name', 'qrs')->first();
        // if(!$lead){
        //     $lead = new lead();
        //     $lead->property_name = 'qrs';
        //     $lead->location = 'India';
        //     $lead->state = 'Uttarakhand';
        //     $lead->district = 'Haridwar';
        //     $lead->prop_type = '2BHK';
        //     $lead->lead_from = '99acres.com';
        //     $lead->status = 2;
        //     $lead->save();
        //     $this->command->info("lead 7 created Uttarakhand");
        // }

        // $lead = lead::where('property_name', 'tuv')->first();
        // if(!$lead){
        //     $lead = new lead();
        //     $lead->property_name = 'tuv';
        //     $lead->location = 'India';
        //     $lead->state = 'Uttarakhand';
        //     $lead->district = 'Haridwar';
        //     $lead->prop_type = '2BHK';
        //     $lead->lead_from = 'housing.com';
        //     $lead->status = 3;
        //     $lead->save();
        //     $this->command->info("lead 8 created Uttarakhand");
        // }

        // $lead = lead::where('property_name', 'wxy')->first();
        // if(!$lead){
        //     $lead = new lead();
        //     $lead->property_name = 'wxy';
        //     $lead->location = 'India';
        //     $lead->state = 'Uttarakhand';
        //     $lead->district = 'Champawat';
        //     $lead->prop_type = '2BHK';
        //     $lead->lead_from = '99acres.com';
        //     $lead->status = 1;
        //     $lead->save();
        //     $this->command->info("lead 9 created Uttarakhand");
        // }
        // $assign = assign::where('employee_id', '3')->first();
        // if(!$assign){
        //     $assign = new assign();
        //     $assign->employee_id = 3;
        //     $assign->property_name = 'wxy';
        //     $assign->salesexecutive = true;
        //     $assign->save();
        //     $this->command->info("assign 1 created.");
        // }
        // $assign = assign::where('employee_id', '3')->first();
        // if($assign){
        //     $assign = new assign();
        //     $assign->employee_id = 3;
        //     $assign->property_name = 'tuv';
        //     $assign->salesexecutive = true;
        //     $assign->save();
        //     $this->command->info("assign 1 created.");
        // }
        // $assign = assign::where('employee_id', '3')->first();
        // if($assign){
        //     $assign = new assign();
        //     $assign->employee_id = 3;
        //     $assign->property_name = 'qrs';
        //     $assign->salesexecutive = true;
        //     $assign->save();
        //     $this->command->info("assign 1 created.");
        // }

        $status = status::where('status', 'active')->first();
        if (!$status) {
            $status = new status();
            $status->status = 'active';
            $status->save();
            $this->command->info("active status created.");
        }

        $status = status::where('status', 'sold')->first();
        if (!$status) {
            $status = new status();
            $status->status = 'sold';
            $status->save();
            $this->command->info("active status created.");
        }

        $prop_type = proptype::where('prop_type', '2BHK')->first();
        if (!$prop_type) {
            $prop_type = new proptype();
            $prop_type->prop_type = '2BHK';
            $prop_type->save();
            $this->command->info("2BHK property type created.");
        }

        $prop_type = proptype::where('prop_type', '3BHK')->first();
        if (!$prop_type) {
            $prop_type = new proptype();
            $prop_type->prop_type = '3BHK';
            $prop_type->save();
            $this->command->info("3BHK property type created.");
        }

        $prop_type = proptype::where('prop_type', '4BHK')->first();
        if (!$prop_type) {
            $prop_type = new proptype();
            $prop_type->prop_type = '4BHK';
            $prop_type->save();
            $this->command->info("4BHK property type created.");
        }

        $prop_type = proptype::where('prop_type', 'villa')->first();
        if (!$prop_type) {
            $prop_type = new proptype();
            $prop_type->prop_type = 'VILLA';
            $prop_type->save();
            $this->command->info("villa property type created.");
        }

        $areamanpage = areamanpage::where('id', 1)->first();
        if (!$areamanpage) {
            $areamanpage = new areamanpage();
            $areamanpage->message = true;
            $areamanpage->whatsapp = true;
            $areamanpage->calendar = true;
            $areamanpage->employees = true;
            $areamanpage->add_user = true;
            $areamanpage->apex = true;
            $areamanpage->clients = true;
            $areamanpage->gen_leads = true;
            $areamanpage->add_lead = true;
            $areamanpage->gen_prop = true;
            $areamanpage->add_prop = true;
            $areamanpage->save();
            $this->command->info("permissions for area manager page created.");
        }

        $manpage = manpage::where('id', 1)->first();
        if (!$manpage) {
            $manpage = new manpage();
            $manpage->message = true;
            $manpage->whatsapp = true;
            $manpage->calendar = true;
            $manpage->employees = true;
            $manpage->add_user = true;
            $manpage->apex = true;
            $manpage->gen_leads = true;
            $manpage->add_lead = true;
            $manpage->gen_prop = true;
            $manpage->add_prop = true;
            $manpage->save();
            $this->command->info("permissions for manager page created.");
        }

        $exepage = exepage::where('id', 1)->first();
        if (!$exepage) {
            $exepage = new exepage();
            $exepage->message = true;
            $exepage->whatsapp = true;
            $exepage->calendar = true;
            $exepage->employees = true;
            $exepage->add_user = true;
            $exepage->apex = true;
            $exepage->gen_leads = true;
            $exepage->add_lead = true;
            $exepage->gen_prop = true;
            $exepage->add_prop = true;
            $exepage->assign = true;
            $exepage->save();
            $this->command->info("permissions for executive page created.");
        }

        $telepage = telepage::where('id', 1)->first();
        if (!$telepage) {
            $telepage = new telepage();
            $telepage->message = true;
            $telepage->whatsapp = true;
            $telepage->calendar = true;
            $telepage->employees = true;
            $telepage->add_user = true;
            $telepage->apex = true;
            $telepage->gen_leads = true;
            $telepage->add_lead = true;
            $telepage->gen_prop = true;
            $telepage->add_prop = true;
            $telepage->save();
            $this->command->info("permissions for telecaller page created.");
        }
    }
}
