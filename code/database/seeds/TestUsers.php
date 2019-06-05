<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\UserRole;

class TestUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Get to-be-tested roles
        $adminRole = Role::whereCode('administrator')->firstOrFail();
        $tradeManagerRole = Role::whereCode('trade_manager')->firstOrFail();
        $traderRole = Role::whereCode('trader')->firstOrFail();

        // Remove all existing users and their roles
        User::truncate();
        UserRole::truncate();

        // Create test users w/ roles attached
        $admin = User::create(array(
            'name' => 'Krisjanis Admin',
            'surname' => 'Veinbahs',
            'info'=> 'Life happens. Coffee helps.',
            'email' => 'admin@hatshop.test', 
            'password' => bcrypt('secret'),
            'yarn' => 200.25
        ));
        $admin->roles()->attach($adminRole->id);

        $tradeManager = User::create(array(
            'name' => 'Krisjanis Trademanager',
            'surname' => 'Veinbahs',
            'info'=> 'How much does a hipster weigh? An Instagram.',
            'email' => 'trademanager@hatshop.test', 
            'password' => bcrypt('secret'),
            'yarn' => 200.25
        ));
        $tradeManager->roles()->attach($tradeManagerRole->id);

        $trader = User::create(array(
            'name' => 'Krisjanis Trader',
            'surname' => 'Veinbahs',
            'info'=> 'The shovel was a ground breaking invention.',
            'email' => 'trader@hatshop.test', 
            'password' => bcrypt('secret'),
            'yarn' => 200.25
        ));
        $trader->roles()->attach($trader->id);
    }
}
