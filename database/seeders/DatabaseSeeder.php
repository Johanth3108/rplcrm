<?php

namespace Database\Seeders;

use App\Models\lead;
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
            $user->state = 'Rajasthan';
            $user->district = 'Bharatpur';
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: salesexecutive created.");
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

        $lead = lead::where('property_name', 'abc')->first();
        if(!$lead){
            $lead = new lead();
            $lead->property_name = 'abc';
            $lead->location = 'India';
            $lead->state = 'Tamil Nadu';
            $lead->district = 'Chennai';
            $lead->prop_type = '2BHK';
            $lead->lead_from = 'housing.com';
            $lead->save();
            $this->command->info("lead 1 created");
        }

        $lead = lead::where('property_name', 'cde')->first();
        if(!$lead){
            $lead = new lead();
            $lead->property_name = 'cde';
            $lead->location = 'India';
            $lead->state = 'Tamil Nadu';
            $lead->district = 'Chennai';
            $lead->prop_type = '2BHK';
            $lead->lead_from = 'housing.com';
            $lead->save();
            $this->command->info("lead 2 created");
        }

        $lead = lead::where('property_name', 'efg')->first();
        if(!$lead){
            $lead = new lead();
            $lead->property_name = 'efg';
            $lead->location = 'India';
            $lead->state = 'Tamil Nadu';
            $lead->district = 'Coimbatore';
            $lead->prop_type = '2BHK';
            $lead->lead_from = 'housing.com';
            $lead->save();
            $this->command->info("lead 3 created");
        }

        $lead = lead::where('property_name', 'hij')->first();
        if(!$lead){
            $lead = new lead();
            $lead->property_name = 'hij';
            $lead->location = 'India';
            $lead->state = 'Gujarat';
            $lead->district = 'Amreli';
            $lead->prop_type = '2BHK';
            $lead->lead_from = 'housing.com';
            $lead->save();
            $this->command->info("lead 4 created Gujarat");
        }

        $lead = lead::where('property_name', 'klm')->first();
        if(!$lead){
            $lead = new lead();
            $lead->property_name = 'klm';
            $lead->location = 'India';
            $lead->state = 'Gujarat';
            $lead->district = 'Aravalli';
            $lead->prop_type = '2BHK';
            $lead->lead_from = 'housing.com';
            $lead->save();
            $this->command->info("lead 5 created Gujarat");
        }

        $lead = lead::where('property_name', 'nop')->first();
        if(!$lead){
            $lead = new lead();
            $lead->property_name = 'nop';
            $lead->location = 'India';
            $lead->state = 'Gujarat';
            $lead->district = 'Bhavnagar';
            $lead->prop_type = '2BHK';
            $lead->lead_from = 'housing.com';
            $lead->save();
            $this->command->info("lead 6 created Gujarat");
        }

        $lead = lead::where('property_name', 'qrs')->first();
        if(!$lead){
            $lead = new lead();
            $lead->property_name = 'qrs';
            $lead->location = 'India';
            $lead->state = 'Uttarakhand';
            $lead->district = 'Bageshwar';
            $lead->prop_type = '2BHK';
            $lead->lead_from = 'housing.com';
            $lead->save();
            $this->command->info("lead 7 created Uttarakhand");
        }

        $lead = lead::where('property_name', 'tuv')->first();
        if(!$lead){
            $lead = new lead();
            $lead->property_name = 'tuv';
            $lead->location = 'India';
            $lead->state = 'Uttarakhand';
            $lead->district = 'Chamoli';
            $lead->prop_type = '2BHK';
            $lead->lead_from = 'housing.com';
            $lead->save();
            $this->command->info("lead 8 created Uttarakhand");
        }

        $lead = lead::where('property_name', 'wxy')->first();
        if(!$lead){
            $lead = new lead();
            $lead->property_name = 'wxy';
            $lead->location = 'India';
            $lead->state = 'Uttarakhand';
            $lead->district = 'Champawat';
            $lead->prop_type = '2BHK';
            $lead->lead_from = 'housing.com';
            $lead->save();
            $this->command->info("lead 9 created Uttarakhand");
        }
    }
}
