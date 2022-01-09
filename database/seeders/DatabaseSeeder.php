<?php

namespace Database\Seeders;

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
            $user->email_verified_at = now();
            $user->password = bcrypt('12345'); // RUN ```PHP ARTISAN TINKER``` IN YOUR TERMINAL, AND RUN ```HASH:MAKE('$YOUR PASSWORD')```
            $user->save();
            $this->command->info("User: telecaller created.");
        }
    }
}
