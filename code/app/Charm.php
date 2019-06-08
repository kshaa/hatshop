<?php

namespace App;

use Illuminate\Validation\ValidationException;
use Validator;
use RuntimeException;

class Charm extends Product
{
    /**
     * Charm creation validation rules and corresponding messages
     */
    public $rules = [
        'creator_id' => 'required|integer|exists:users,id',
        'owner_id' => 'required|integer|exists:users,id',
        'color' => [ 'required', 'string', 'regex:/^#([0-9]|[a-f]|[A-F]){6}$/' ],
        'label' => 'required|string',
        'active' => 'boolean',
        'code' => [ 'required', 'string', 'regex:/^([a-z]|_|[0-9])+$/', 'unique:charms,code' ],
        'description' => 'required|string',
        'power_label' => 'required|string',
        'power_code' => [ 'required', 'string', 'regex:/^([a-z]|_|[0-9])+$/', 'unique:charms,power_code' ],
        'power_intensity' => 'required|integer',
    ];
    public $ruleMessages = [
        'code.regex' => "Code must be formatted using lowercase letters, digits and underscores.",
        'power_code.regex' => "Power code must be formatted using lowercase letters, digits and underscores."
    ];

    /**
     * Get all trades of this product.
     */
    public function trades()
    {
        return $this->hasMany(Trade::class, 'product_id');
    }

    /**
     * All hats that this charm is attached to.
     */
    public function hats()
    {
        return $this->belongsToMany(User::class, 'hat_charms', 'hat_id', 'charm_id')->withTimestamps();
    }

    /**
     * A validation function for charm creation:
     */
    public function validate($data = []) {
        $validator = Validator::make($data, $this->rules, $this->ruleMessages);

        # Is all data required for deal initialization present?
        if (!$validator->passes()) {
            throw new ValidationException($validator, "Charm creation data is invalid");
        }

        return $this;
    }
}
