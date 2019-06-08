<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * User creation validation rules and corresponding messages
     */
    public $rules = [
        'info' => 'required|string',
        'name' => 'required|string',
        'surname' => 'required|string'
    ];

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
     * The Yarn (money) symbol
     */
    static $yarnSymbol = "Ҩ";

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles')->withTimestamps();
    }

    /**
     * Check if user has a certain role
     */
    public function hasRole($roleCode)
    {
        $roleQuery = $this->roles()->where('code', '=', $roleCode)->get();

        return count($roleQuery) > 0;
    }

    /**
     * All roles that a user could theoretically have
     */
    public function availableRoles()
    {
        return Role::all();
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

    /**
     * All sales that belong to the user.
     */
    public function sales()
    {
        return $this->hasMany(Trade::class, 'seller_id');
    }

    /**
     * All purchases that belong to the user.
     */
    public function purchases()
    {
        return $this->hasMany(Trade::class, 'buyer_id');
    }

    /**
     * Get a formatted amount of user Yarn (money)
     */
    public function formattedYarn()
    {
        return $this->yarn . self::$yarnSymbol;
    }
}
