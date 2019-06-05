<?php

use Illuminate\Database\Seeder;
use App\Role;

class GenericRoles extends Seeder
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
            'name' => 'Administrator',
            'code' => 'administrator',
            'comment' => 'A trade manager w/ permission to create more trade managers.'
        ));
        Role::create(array(
            'name' => 'Trade manager',
            'code' => 'trade_manager',
            'comment' => 'A trader w/ permission to approve the new products.'
        ));
        Role::create(array(
            'name' => 'Trader',
            'code' => 'trader',
            'comment' => 'Can create/import new products (charms/hats) and trade them.'
        ));
    }
}
