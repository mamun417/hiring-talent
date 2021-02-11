<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TalentMessage;
use App\Models\Talent;
use Illuminate\Http\Request;
use Mail;

class TalentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:talent show|talent send message', ['only' => ['index']]);
        $this->middleware('permission:talent show')->only(['show']);
        $this->middleware('permission:talent send message')->only(['talentMessageSend']);
    }

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all latest products
        $talents = Talent::with('images', 'refererBy')->latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $talents = $talents->where('talent_name', 'like', $keyword)
                ->orWhere('parent_name', 'like', $keyword)
                ->orWhere('email', 'like', $keyword)
                ->orWhere('phone', 'like', $keyword)
                ->orWhere('date_of_birth', 'like', $keyword)
                ->orWhere('gender', 'like', $keyword)
                ->orWhere('eye_color', 'like', $keyword)
                ->orWhere('hair_color', 'like', $keyword)
                ->orWhere('subject', 'like', $keyword);
        }

        $talents = $talents->paginate($perPage);

        return view('admin.pages.talents.index', compact('talents'));
    }

    public function show(Talent $talent)
    {
        return view('admin.pages.talents.details', compact('talent'));
    }


    public function talentMessageSend(Request $request)
    {

        $request->validate([
            'talent_email' => 'required',
            'subject' => 'required',
            'message_body' => 'required',
        ]);

        $details = $request->only(['talent_email', 'subject', 'message_body']);

        Mail::to($details['talent_email'])->send(new TalentMessage($details));

        return redirect()->back()->with('success', 'Message Successfully Send');
    }


}
