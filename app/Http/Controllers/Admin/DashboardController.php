<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Slider;
use App\Models\Talent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $talents = Talent::all();
        $messages = Message::all();
        $sliders = Slider::all();
        return view('admin.dashboard', compact(
            'users', 'talents', 'messages', 'sliders',
        ));
    }

}
