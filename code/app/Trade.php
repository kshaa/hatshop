<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Validator;
use RuntimeException;

class Trade extends Model
{
    /**
     * Trade model data validation rules
     */
    protected $rules = array(
        'seller_id' => 'required|exists:users,id',
        'buyer_id' => 'exists:users,id',
        'yarn' => 'required|integer|min:1',
        'product_type' => 'required|string',
        'product_id' => 'required|integer'
    );

    protected $completeRules = array(
        'buyer_id' => 'required|exists:users,id',
    );

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
     * - Validate trade creation
     * - Fill in trade record
     */
    public function start($data = []) {
        $this->validateStart($data);

        # Fill in trade record
        $this->seller_id = $data['seller_id'];
        $this->product_type = $data['product_type'];
        $this->product_id = $data['product_id'];
        $this->yarn = $data['yarn'];
        $this->save();

        return $this;
    }

    /**
     * A validation function for a trade deal initialization:
     * - Is all data required for deal initialization present?
     */
    public function validateStart($data = []) {
        $validator = Validator::make($data, $this->rules);

        # Is all data required for deal initialization present?
        if (!$validator->passes()) {
            throw new ValidationException($validator, "Initial trade information isn't valid");
        }

        return $this;
    }

    /**
     * Complete a trade:
     * - Validate trade completion
     * - Fill in trade record
     * - Take money from buyer
     * - Give money to seller
     */
    public function complete($data = []) {
        # Validate trade completion
        $this->validateComplete($data);

        # Fill in trade record
        $this->buyer_id = $data['buyer_id'];
        $this->save();

        # Take money from buyer
        $buyer = User::find($data['buyer_id']);
        $buyer->yarn -= $this->yarn;
        $buyer->save();

        # Give money to seller
        $seller = User::find($this->seller_id);
        $seller->yarn += $this->yarn;
        $seller->save();

        return $this;
    }

    /**
     * A validation function for a trade completion:
     * - Is all data required for deal completion present?
     * - The buyer can't be also the seller. 
     * - Does the buyer have enough money?
     */
    public function validateComplete($data = []) {
        # Is all data required for deal completion present?
        $validator = Validator::make($data, $this->completeRules);
        if (!$validator->passes()) {
            throw new ValidationException($validator, "Completion trade information isn't valid");
        }

        # The buyer can't be also the seller
        if ($data['buyer_id'] === $this->seller_id) {
            throw new RuntimeException("The buyer can't also be the seller");
        }

        # Does the buyer have enough money?
        $buyer = User::find($data['buyer_id']);
        if ($buyer->yarn < $this->yarn) {
            throw new RuntimeException("The buyer doesn't have enough money");
        }

        return $this;
    }
}
