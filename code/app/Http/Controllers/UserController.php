<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Show info about a specific charm
     */
    public function show($id) {
        $user = User::findOrFail($id);

        return view('user/show', [
            'user' => $user,
        ]);
    }
}
