<?php

use Illuminate\Database\Seeder;
use App\User;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create test users w/ roles attached
        User::truncate();
        $admin = User::create(array(
            'name' => 'Krisjanis Admin',
            'surname' => 'Veinbahs',
            'info'=> 'Life happens. Coffee helps.',
            'email' => 'admin@hatshop.test', 
            'password' => bcrypt('secret'),
            'yarn' => 200.25
        ));

        $tradeManager = User::create(array(
            'name' => 'Krisjanis Trademanager',
            'surname' => 'Veinbahs',
            'info'=> 'How much does a hipster weigh? An Instagram.',
            'email' => 'trademanager@hatshop.test', 
            'password' => bcrypt('secret'),
            'yarn' => 200.25
        ));

        $trader = User::create(array(
            'name' => 'Krisjanis Trader',
            'surname' => 'Veinbahs',
            'info'=> 'The shovel was a ground breaking invention.',
            'email' => 'trader@hatshop.test', 
            'password' => bcrypt('secret'),
            'yarn' => 200.25
        ));
        
        $temp = User::create(array(
            'name' => 'Temp',
            'surname' => 'Tempinson',
            'info'=> 'Burn quick and bright!.',
            'email' => 'temp@hatshop.test', 
            'password' => bcrypt('secret'),
            'yarn' => 200.25
        ));
    }
}
