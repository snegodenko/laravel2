<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function policy()
    {
        return view('terms.policy');
    }

    public function terms()
    {
        return view('terms.terms');
    }
}
