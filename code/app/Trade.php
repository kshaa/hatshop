<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    /**
     * The user who bought this trade product
     */
    public function buyer() {
        return $this->belongsTo(User::class)->withTimestamps();
    }

    /**
     * The user who is selling/sold this trade product
     */
    public function seller() {
        return $this->belongsTo(User::class)->withTimestamps();
    }

    /**
     * Initialize a trade deal:
     * - Validate trade creation (@todo)
     * - Create a new trade record
     */
    public function start($data = []) {
        $this->validateStart($data);

        // Assign info
        $this->seller_id = $data['seller_id'];
        $this->product_type = $data['product_type'];
        $this->product_id = $data['product_id'];
        $this->yarn = $data['yarn'];

        return $this;
    }

    /**
     * A validation function for a trade deal creation:
     * - Is all data required for deal initialization present?
     * - Does the person own the product to be sold?
     */
    public function validateStart($data = []) {

        return $this;
    }

    /**
     * Finish a trade:
     * - Validate trade completion (@todo)
     * - Remove all relationships to previous hats (@todo)
     * - Take money from buyer (@todo)
     * - Give money to seller (@todo)
     * - Finish trade record
     */
    public function finish($data = []) {
        $this->validateFinish($data);

        // Assign info
        $this->buyer_id = $data['buyer_id'];

        return $this;
    }

    /**
     * A validation function for a trade completion:
     * - Is all data required for deal completion present?
     * - Does the buyer have enough money?
     */
    public function validateFinish($data = []) {
        
        return $this;
    }
}
