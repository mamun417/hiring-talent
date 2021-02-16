<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\FeaturedBrand;
use App\Models\Message;
use App\Models\Reply;
use App\Models\Slider;
use App\Models\Talent;
use App\Models\TalentReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $admins = Admin::count();
        $users = User::count();
        $talents = Talent::count();
        $messages = Message::count();
        $sliders = Slider::count();
        $total_message_replied = Reply::count();
        $total_talent_replied = TalentReply::count();
        $featured_brands = FeaturedBrand::count();
        return view('admin.dashboard', compact(
            'users',
            'talents',
            'messages',
            'sliders',
            'total_message_replied',
            'total_talent_replied',
            'admins',
            'featured_brands',
        ));
    }

}
