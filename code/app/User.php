<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles')->withTimestamps();
    }

    /**
     * All hats that have been created by the user.
     */
    public function createdHats()
    {
        return $this->hasMany(Hat::class, 'creator_id');
    }

    /**
     * All charms that have been created by the user.
     */
    public function createdCharms()
    {
        return $this->hasMany(Charm::class, 'creator_id');
    }

    /**
     * All hats that belong to the user.
     */
    public function ownedHats()
    {
        return $this->hasMany(Hat::class, 'owner_id');
    }

    /**
     * All charms that belong to the user.
     */
    public function ownedCharms()
    {
        return $this->hasMany(Charm::class, 'owner_id');
    }
}
