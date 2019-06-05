<?php

use Illuminate\Database\Seeder;
use App\Role;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::create(array(
            'label' => 'Administrator',
            'code' => 'administrator',
            'comment' => 'A trade manager w/ permission to create more trade managers.'
        ));
        Role::create(array(
            'label' => 'Trade manager',
            'code' => 'trade_manager',
            'comment' => 'A trader w/ permission to approve the new products.'
        ));
        Role::create(array(
            'label' => 'Trader',
            'code' => 'trader',
            'comment' => 'Can create/import new products (charms/hats) and trade them.'
        ));
    }
}
