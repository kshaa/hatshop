<?php

use Illuminate\Database\Seeder;

use App\Charm;
use App\User;

class Charms extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tempUser = User::where('email', '=', 'temp@hatshop.test')->firstOrFail();

        Charm::truncate();
        Charm::create(array(
            'label' => 'Cheetah',
            'code' => 'cheetah',
            'power_label' => 'Speed',
            'power_code' => 'speed',
            'power_intensity' => 1,
            'active' => true,
            'description' => 'This amulet feels like a you\'ve drunk 5 coffees.',
            'color' => '#cdff84',
            'creator_id' => $tempUser->id,
            'owner_id' => $tempUser->id
        ));
        Charm::create(array(
            'label' => 'Kangaroo',
            'code' => 'kangaroo',
            'power_label' => 'High jump',
            'power_code' => 'highjump',
            'power_intensity' => 1,
            'active' => true,
            'description' => 'When you use this amulet you can jump a house.',
            'color' => '#ffd484',
            'creator_id' => $tempUser->id,
            'owner_id' => $tempUser->id
        ));
        Charm::create(array(
            'label' => 'Inactive charm',
            'code' => 'inactive',
            'power_label' => 'Nothing',
            'power_code' => 'nothing',
            'power_intensity' => 1,
            'active' => false,
            'description' => 'An unusable, inactive charm.',
            'color' => '#000000',
            'creator_id' => $tempUser->id,
            'owner_id' => $tempUser->id
        ));
    }
}
