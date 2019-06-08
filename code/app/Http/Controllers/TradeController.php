<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trade;
use App\CharmTrade;
use App\HatTrade;
use App\Hat;
use App\Charm;
use Auth;

class TradeController extends Controller
{
    /**
     * List all trades
     */
    public function index(Request $request) {
        $currentUser = Auth::user();
        $userParam = $request->input('user');

        if ($userParam == 'self') {
            // All purchases or trades of self
            // Active or not
            $trades = Trade::where(function ($query) use($currentUser)  {
                $query->where('buyer_id', '=', $currentUser->id)
                      ->orWhere('seller_id', '=', $currentUser->id);
            })->get();
        } else if ($userParam === 'others') {
            // Active trades of others
            $trades = Trade::where('seller_id', '<>', $currentUser->id)
                ->whereNull('buyer_id')->get();
        } else {
            return redirect()->route('trade_index', ['user' => 'others']);
        }

        return view('trade/index', array('trades' => $trades));
    }

    /**
     * Serve new trade form
     */
    public function new() {
        $user = Auth::user();
        $ownedCharms = $user->ownedCharms()->where('active', true)->get();
        $ownedHats = $user->ownedHats()->where('active', true)->get();

        return view('trade/new', [
            'ownedHats' => $ownedHats,
            'ownedCharms' => $ownedCharms
        ]);
    }

    /**
     * Serve trade view
     */
    public function show($id) {
        $trade = Trade::findOrFail($id);

        return view('trade/show', [ 'trade' => $trade ]);
    }

    /**
     * Serve edit trade form
     */
    public function edit($id) {
        $trade = Trade::findOrFail($id);

        return view('trade/edit', [ 'trade' => $trade ]);
    }

    /**
     * Update a trade
     */
    public function update(Request $request, $id) {
        # Validate data
        $trade = Trade::findOrFail($id);
        $rules = [
            'yarn' => 'required|integer'
        ];
        $validatedData = $request->validate(
            $rules
        );

        # Update and save model
        $trade->yarn = $validatedData['yarn'];
        $trade->save();

        # Respond with a redirect to the newly created model
        return redirect()->route('trade_show', ['id' => $trade->id]);
    }

    /**
     * Complete a trade
     */
    public function complete(Request $request, $id) {
        $trade = Trade::findOrFail($id);
        if ($trade->product_type === Hat::class) {
            $trade = HatTrade::findOrFail($id);
        } else if ($trade->product_type === Charm::class) {
            $trade = CharmTrade::findOrFail($id);
        }
        
        $trade->complete(['buyer_id' => Auth::user()->id]);
        
        # Respond with a redirect to the newly created model
        return redirect()->route('trade_show', ['id' => $trade->id]);
    }

    /**
     * Serve new trade form
     */
    public function create(Request $request) {
        # Validate data
        $trade = Trade::make();
        $rules = [
            'charm_or_hat' => 'required|string|in:charm,hat',
            'hat_id' => 'integer',
            'charm_id' => 'integer',
            'yarn' => 'required|integer'
        ];
        $validatedData = $request->validate(
            $rules
        );
        $user = Auth::user();

        if ($validatedData['charm_or_hat'] == 'charm') {
            $charmTrade = CharmTrade::make();
            $charmTrade->start([
                'seller_id' => $user->id,
                'product_id' => $validatedData['charm_id'],
                'yarn' => $validatedData['yarn']
            ]);
        } else if ($validatedData['charm_or_hat'] == 'hat') {
            $hatTrade = HatTrade::make();
            $hatTrade->start([
                'seller_id' => $user->id,
                'product_id' => $validatedData['hat_id'],
                'yarn' => $validatedData['yarn']
            ]);  
        } else {
            throw ValidationException::withMessages([
                'charm_or_hat' => ["Can't tell if trading hat or charm..."],
            ]);
        }

        # Respond with a redirect to the newly created model
        return redirect()->route('trade_show', [ 'id' => $trade->id ]);
    }

    /**
     * Delete a trade
     */
    public function delete($id) {
        $trade = Trade::findOrFail($id);
        $trade->delete();

        return redirect()->route('trade_index');
    }
}
