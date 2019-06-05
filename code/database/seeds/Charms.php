<?php

use Illuminate\Database\Seeder;

use App\Charm;

class Charms extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Charm::truncate();
        Charm::create(array(
            'label' => 'Cheetah',
            'code' => 'cheetah',
            'active' => true,
            'description' => 'This amulet feels like a you\'ve drunk 5 coffees.'
        ));
        Charm::create(array(
            'label' => 'Kangaroo',
            'code' => 'kangaroo',
            'active' => true,
            'description' => 'When you use this amulet you can jump a house.'
        ));
        Charm::create(array(
            'label' => 'Inactive charm',
            'code' => 'inactive',
            'active' => false,
            'description' => 'An unusable, inactive charm.'
        ));
    }
}
