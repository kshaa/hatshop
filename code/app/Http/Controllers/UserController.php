<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Show list of users
     */
    public function index() {
        $users = User::where('id', '<>', Auth::user()->id)->get();

        return view('user/index', [
            'users' => $users,
        ]);
    }

    /**
     * Show info about a specific charm
     */
    public function show($id) {
        $user = User::findOrFail($id);

        return view('user/show', [
            'user' => $user,
        ]);
    }

    /**
     * Serve user edit form
     */
    public function edit($id) {
        $user = User::findOrFail($id);

        return view('user/edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update a user
     */
    public function update(Request $request, $id) {
        # Validate data
        $user = User::findOrFail($id);
        $originalRules = $user->rules;
        $rules = [];
        if (Auth::user()->hasRole('administrator')) {
            $rules['roles'] = 'array';
        }
        $rules['name'] = $originalRules['name'];
        $rules['surname'] = $originalRules['surname'];
        $rules['info'] = $originalRules['info'];
        $validatedData = $request->validate(
            $rules
        );

        # Update and save model
        if (Auth::user()->hasRole('administrator')) {
            ## Update hat relations
            $roles = array_key_exists('roles', $validatedData) ? $validatedData['roles'] : [];
            $user->roles()->sync($roles);
        }

        ## Update general info
        $user->name = $validatedData['name'];
        $user->surname = $validatedData['surname'];
        $user->info = $validatedData['info'];
        $user->save();

        # Respond with a redirect to the newly created model
        return redirect()->route('user_show', ['id' => $user->id]);
    }
}
