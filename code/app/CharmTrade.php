<?php

namespace App;

use RuntimeException;

class CharmTrade extends Trade
{
    protected $table = 'trades';

    /**
     * Create a new CharmTrade Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->rules['product_id'] = 'required|integer|exists:charms,id';
    }

    /**
     * Initialize a trade deal:
     * - Validate trade creation
     * - Create a new trade record
     */
    public function start($data = []) {
        $data['product_type'] = Charm::class;

        parent::start($data);
    }

    /**
     * A validation function for a charm trade deal creation:
     * - Is all data required for deal initialization present?
     * - Does the seller own the charm?
     */
    public function validateStart($data = []) {
        # Is all data required for deal initialization present?
        parent::validateStart($data);

        # Does the seller own the charm?
        $sellerProduct = User::find($data['seller_id'])
            ->ownedCharms()
            ->where('id', $data['product_id']);

        if (!$sellerProduct) {
            throw RuntimeException("The seller doesn't own the charm to be traded");
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

        # Remove all relationships to previous hats
        HatCharm::where('charm_id', $this->product_id)->delete();

        # Transfer ownership
        $tradedCharm = Charm::find($this->product_id);
        $tradedCharm->owner_id = $this->buyer_id;
        $tradedCharm->save();

        return $this;
    }
}
