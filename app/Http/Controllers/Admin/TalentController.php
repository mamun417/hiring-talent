<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Mail\TalentMessage;
use App\Models\Talent;
use App\Models\TalentReply;
use Illuminate\Http\Request;
use Mail;

class TalentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:talent show|talent delete|talent reply|talent reply show|talent reply delete', ['only' => ['index']]);
        $this->middleware('permission:talent show')->only(['show']);
        $this->middleware('permission:talent delete')->only(['destroy']);
        $this->middleware('permission:talent reply')->only(['talentMessageSend']);
        $this->middleware('permission:talent reply show|talent reply delete')->only(['messageReplies']);
        $this->middleware('permission:talent reply delete')->only(['replyDestroy']);
    }



    public function messageReplies(Talent $talent)
    {
        $replies = $talent->replies()->paginate(10);
        return view("admin.pages.talents.replies", compact('replies', 'talent'));
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
            'talent_id' => 'required',
            'talent_email' => 'required|email',
            'subject' => 'required',
            'message_body' => 'required',
        ]);

        $details = $request->only(['talent_email', 'subject', 'message_body', 'talent_id']);

        Mail::to($details['talent_email'])->send(new TalentMessage($details));

        TalentReply::create($details);
        return redirect()->back()->with('success', 'Message Successfully Send');
    }

    public function destroy(Talent $talent)
    {
        if ($talent && $talent->images) {
            foreach ($talent->images as $image) {
                FileHandler::delete($image->base_path ? $image->base_path : null);
            }
        }

        $talent->delete();
        return redirect()->back()->with('success', 'Talent Deleted Successfully');
    }

    public function replyDestroy(TalentReply $talentReply){
        $talentReply->delete();
        return redirect()->back()->with('success', 'Reply Deleted Successfully');
    }
}
