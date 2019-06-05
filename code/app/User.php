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
        return $this->belongsToMany(Hat::class, 'hats', 'id', 'creator_id');
    }

    /**
     * All charms that have been created by the user.
     */
    public function createdCharms()
    {
        return $this->belongsToMany(Charm::class, 'charms', 'id', 'creator_id');
    }

    /**
     * All hats that belong to the user.
     */
    public function ownedHats()
    {
        return $this->belongsToMany(Hat::class, 'hats', 'id', 'owner_id');
    }

    /**
     * All charms that belong to the user.
     */
    public function ownedCharms()
    {
        return $this->belongsToMany(Charm::class, 'charms', 'id', 'owner_id');
    }
}
