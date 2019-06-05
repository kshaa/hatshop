<?php

namespace App;

class Charm extends Product
{
    /**
     * All hats that this charm is attached to.
     */
    public function hats()
    {
        return $this->belongsToMany(User::class, 'hat_charms', 'hat_id', 'charm_id')->withTimestamps();
    }
}
