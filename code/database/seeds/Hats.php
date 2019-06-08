<?php

use Illuminate\Database\Seeder;

use App\Hat;

class Hats extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hat::truncate();
        Hat::create(array(
            'label' => 'Cowboy hat',
            'code' => 'cowboy',
            'active' => true,
            'description' => 'A trendy hat with a hint of Texas.',
            // This should already be added in storage manually
            'model_path' => 'public/model/lhJs2coyIxt1uP9JDwkBMDCrlMGlHCMfxKs4Udx8/scene.gltf'
        ));
        Hat::create(array(
            'label' => 'Top hat',
            'code' => 'top',
            'active' => true,
            'description' => 'A classy hat to make you feel upper class.',
            // This should already be added in storage manually
            'model_path' => 'public/model/autWIpNoPfwtTvftCmnWyG5vx6nefMcquJqfmSYJ/scene.gltf'
        ));
        Hat::create(array(
            'label' => 'Inactive hat',
            'code' => 'inactive',
            'active' => false,
            'description' => 'An unusable, inactive hat.',
        ));
    }
}
