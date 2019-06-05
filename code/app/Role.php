<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Users that belong to this role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles')->withTimestamps();
    }
}
