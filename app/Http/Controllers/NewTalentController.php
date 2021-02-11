<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewTalentController extends Controller
{
    public function index()
    {
        return view('pages.talent.new-talent');
    }
}
