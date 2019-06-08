<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Hat extends Product
{
    /**
     * Hat creation validation rules and corresponding messages
     */
    public $rules = [
        'creator_id' => 'required|integer|exists:users,id',
        'owner_id' => 'required|integer|exists:users,id',
        'label' => 'required|string',
        'active' => 'boolean',
        'code' => [ 'required', 'string', 'regex:/^([a-z]|_|[0-9])+$/', 'unique:charms,code' ],
        'description' => 'required|string',
        'model_path' => 'required|string',
        'model_archive' => 'required|file|mimes:zip|max:10240',
    ];
    public $ruleMessages = [
        'code.regex' => "Code must be formatted using lowercase letters, digits and underscores.",
    ];

    /**
     * Get all trades of this product.
     */
    public function trades()
    {
        return $this->morphMany(Trade::class, 'product');
    }

    /**
     * All charms that are attached to this hat.
     */
    public function charms()
    {
        return $this->belongsToMany(Charm::class, 'hat_charms', 'charm_id', 'hat_id')->withTimestamps();
    }

    /**
     * Return a public URL to the model
     * Scheme and host not included
     */
    public function hatModelUrl()
    {
        return Storage::url($this->model_path);
    }

    /**
     * Check if charm is connected to a certain hat
     */
    public function hasCharm($charmCode) {
        $charmQuery = $this->charms()->where('code', '=', $charmCode)->get();

        return count($charmQuery) > 0;
    }
}
