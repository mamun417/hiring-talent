<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use App\Models\Message;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:message reply|message reply show|message reply delete', ['only' => ['messageReplies']]);
        $this->middleware('permission:message reply show|message reply delete')->only(['messageReplies']);
        $this->middleware('permission:message reply')->only(['store']);
        $this->middleware('permission:message reply delete')->only(['destroy']);
    }

    public function messageReplies(Message $message)
    {
        $replies = $message->replies()->paginate(10);
        return view("admin.pages.messages.replies", compact('replies', 'message'));
    }


    public function create()
    {
        return abort(404);
    }


    public function store(ReplyRequest $request)
    {
        $reply_details = $request->only(['message_id', 'reply_email', 'reply_subject', 'reply_message', 'name']);

        Mail::to($reply_details['reply_email'])->send(new \App\Mail\ReplyMessage($reply_details));
        Reply::create($reply_details);

        DB::commit();
        return redirect()->back()->with('success', 'Reply Sent Successfully');
    }


    public function show($id)
    {
        return abort(404);
    }


    public function edit($id)
    {
        return abort(404);
    }


    public function update(Request $request, $id)
    {
        return abort(404);
    }


    public function destroy(Reply $reply)
    {
        $reply->delete();
        return redirect()->back()->with('success', 'Reply Successfully Deleted');
    }

}
