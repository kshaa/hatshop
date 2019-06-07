<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HatController extends Controller
{
    /**
     * List all user hats
     */
    public function index() {
        $userHats = Auth::user()->ownedHats()->get();

        return view('hat/index', array('hats' => $userHats));
    }
}
