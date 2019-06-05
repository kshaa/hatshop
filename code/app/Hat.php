<?php

namespace App;

class Hat extends Product
{
    /**
     * All charms that are attached to this hat.
     */
    public function charms()
    {
        return $this->belongsToMany(Charm::class, 'hat_charms', 'charm_id', 'hat_id')->withTimestamps();
    }
}
