<?php

use Illuminate\Database\Seeder;

use App\Charm;
use App\Hat;
use App\Role;
use App\User;
use App\UserRole;
use App\HatCharm;

class UserRelationships extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Find test users
        $admin = User::whereEmail('admin@hatshop.test')->firstOrFail();
        $tradeManager = User::whereEmail('trademanager@hatshop.test')->firstOrFail();
        $trader = User::whereEmail('trader@hatshop.test')->firstOrFail();

        # Find roles and attach to users
        UserRole::truncate();

        $adminRole = Role::whereCode('administrator')->firstOrFail();
        $tradeManagerRole = Role::whereCode('trade_manager')->firstOrFail();
        $traderRole = Role::whereCode('trader')->firstOrFail();

        $admin->roles()->attach($adminRole->id);
        $tradeManager->roles()->attach($tradeManagerRole->id);
        $trader->roles()->attach($traderRole->id);

        # Find hats & charms, attach to users & each other
        HatCharm::truncate();

        ## Find hats and attach to users
        $cowboyHat = Hat::whereCode('cowboy')->firstOrFail();
        $topHat = Hat::whereCode('top')->firstOrFail();
        $inactiveHat = Hat::whereCode('inactive')->firstOrFail();

        $topHat->creator_id = $admin->id;
        $cowboyHat->creator_id = $admin->id;
        $inactiveHat->creator_id = $admin->id;

        $topHat->owner_id = $tradeManager->id;
        $cowboyHat->owner_id = $trader->id;
        $inactiveHat->owner_id = $trader->id;

        $topHat->save();
        $cowboyHat->save();
        $inactiveHat->save();

        ## Find charms and attach to users
        $cheetahCharm = Charm::whereCode('cheetah')->firstOrFail();
        $kangarooCharm = Charm::whereCode('kangaroo')->firstOrFail();
        $inactiveCharm = Charm::whereCode('inactive')->firstOrFail();

        $cheetahCharm->creator_id = $admin->id;
        $kangarooCharm->creator_id = $admin->id;
        $inactiveCharm->creator_id = $admin->id;

        $cheetahCharm->owner_id = $tradeManager->id;
        $kangarooCharm->owner_id = $trader->id;
        $inactiveCharm->owner_id = $trader->id;

        $cheetahCharm->save();
        $kangarooCharm->save();
        $inactiveHat->save();

        ## Attach user charms to user hats
        $cheetahCharm->hats()->attach($topHat->id);
        $kangarooCharm->hats()->attach($inactiveHat->id);
        $inactiveCharm->hats()->attach($inactiveHat->id);
    }
}
