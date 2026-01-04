<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class LoginController extends Controller
{ 
    public function index() {
        return view('login.index');
    }

    public function store(Request $request) {

    _alert('success', __('Welcome'));

    return redirect()->route('user.posts');
    }
}
