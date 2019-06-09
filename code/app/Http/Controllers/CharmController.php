<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Charm;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\UnauthorizedException;

class CharmController extends Controller
{
    /**
     * List all user charms
     */
    public function index() {
        $userCharms = Auth::user()->ownedCharms()->get();

        return view('charm/index', array('charms' => $userCharms));
    }

    /**
     * Show info about a specific charm
     */
    public function show($id) {
        $charm = Charm::findOrFail($id);
        $owner = $charm->owner;
        $creator = $charm->creator;

        return view('charm/show', [
            'charm' => $charm,
            'owner' => $owner,
            'creator' => $creator
        ]);
    }

    /**
     * Serve new charm form
     */
    public function new() {
        return view('charm/new');
    }

    /**
     * Serve new charm form
     */
    public function create(Request $request) {
        # Validate data
        $charm = Charm::make();
        $ruleMessages = $charm->ruleMessages;
        $rules = $charm->rules;
        unset($rules['creator_id']);
        unset($rules['owner_id']);
        $validatedData = $request->validate(
            $rules,
            $ruleMessages
        );

        # Create and save model
        $user = Auth::user();
        $charm->label = $validatedData['label'];
        $charm->description = $validatedData['description'];
        $charm->code = $validatedData['code'];
        $charm->color = $validatedData['color'];
        $charm->power_label = $validatedData['power_label'];
        $charm->power_code = $validatedData['power_code'];
        $charm->power_intensity = $validatedData['power_intensity'];
        $charm->creator_id = $user->id;
        $charm->owner_id = $user->id;
        $charm->save();

        # Respond with a redirect to the newly created model
        return redirect()->route('charm_show', ['id' => $charm->id]);
    }

    /**
     * Edit a charm
     */
    public function edit($id) {
        $charm = Charm::findOrFail($id);

        if (
            Gate::denies('user-role', ['administrator']) &&
            Gate::denies('user-role', ['trade_manager']) &&
            Gate::denies('model-owner', $charm->owner)
        ) {
            throw new UnauthorizedException();
        }

        return view('charm/edit', [ 'charm' => $charm ]);
    }

    /**
     * Update a charm
     */
    public function update(Request $request, $id) {
        $charm = Charm::findOrFail($id);

        if (
            Gate::denies('user-role', ['administrator']) &&
            Gate::denies('user-role', ['trade_manager']) &&
            Gate::denies('model-owner', $charm->owner)
        ) {
            throw new UnauthorizedException();
        }

        # Validate data
        $ruleMessages = $charm->ruleMessages;
        $originalRules = $charm->rules;
        $rules = [];
        if (Auth::user()->hasRole('administrator') || Auth::user()->hasRole('trade_manager')) {
            $rules['active'] = $originalRules['active'];
        }
        $rules['hats'] = 'array';
        $rules['label'] = $originalRules['label'];
        $rules['description'] = $originalRules['description'];
        $rules['color'] = $originalRules['color'];
        $validatedData = $request->validate(
            $rules,
            $ruleMessages
        );

        # Update and save model
        ## Update hat relations
        $hats = array_key_exists('hats', $validatedData) ? $validatedData['hats'] : [];
        $charm->hats()->sync($hats);

        ## Update general info
        $charm->active = array_key_exists('active', $validatedData) && $validatedData['active'];
        $charm->label = $validatedData['label'];
        $charm->description = $validatedData['description'];
        $charm->color = $validatedData['color'];

        $charm->save();

        # Respond with a redirect to the newly created model
        return redirect()->route('charm_show', ['id' => $charm->id]);
    }

    /**
     * Delete a charm
     */
    public function delete($id) {
        $charm = Charm::findOrFail($id);

        if (
            Gate::denies('user-role', ['administrator']) &&
            Gate::denies('model-owner', $charm->owner)
        ) {
            throw new UnauthorizedException();
        }

        $charm->delete();

        return redirect()->route('charm_index');
    }
}
