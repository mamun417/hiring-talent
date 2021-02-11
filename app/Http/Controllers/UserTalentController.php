<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class UserTalentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $talent = $user->talent;
        return view('pages.profile.talent', compact('user', 'talent'));
    }
}
