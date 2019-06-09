<?php

namespace App;

use RuntimeException;

class HatTrade  extends Trade
{
    protected $table = 'trades';

    /**
     * Create a new HatTrade Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->rules['product_id'] = 'required|integer|exists:hats,id';
    }

    /**
     * Initialize a trade deal:
     * - Validate trade creation
     * - Create a new trade record
     */
    public function start($data = []) {
        $data['product_type'] = Hat::class;

        parent::start($data);
    }

    /**
     * A validation function for a hat trade deal creation:
     * - Is all data required for deal initialization present?
     * - Does the seller own the hat?
     */
    public function validateStart($data = []) {
        # Is all data required for deal initialization present?
        parent::validateStart($data);

        # Does the seller own the hat?
        $sellerProduct = User::find($data['seller_id'])
            ->ownedHats()
            ->where('id', $data['product_id']);

        if (!$sellerProduct) {
            throw new RuntimeException("The seller doesn't own the hat to be traded");
        }

        return $this;
    }

    /**
     * Complete a trade:
     * - Validate trade completion
     * - Fill in trade record
     * - Take money from buyer
     * - Give money to seller
     * - Remove all relationships to previous hats
     * - Transfer ownership
     */
    public function complete($data = []) {
        # Validate trade completion
        # Fill in trade record
        # Take money from buyer
        # Give money to seller   
        parent::complete($data);

        $tradedHat = Hat::find($this->product_id);

        # Transfer ownership
        $tradedHat->owner_id = $this->buyer_id;

        # Remove all relationships to previous charms
        $tradedHat->charms()->sync([]);

        $tradedHat->save();

        return $this;
    }
}
