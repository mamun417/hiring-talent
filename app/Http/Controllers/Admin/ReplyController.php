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


    public function store(Request $request)
    {
        $request->validate([
            'reply_subject' => 'required',
            'reply_message' => 'required',
        ]);

        //Start => send mail to all customers section
        if ($request->mail_to === 'all') {
            $this->sendMailToAllMessages($request);
            return redirect()->back()->with('success', 'Reply Sent Successfully');
        }
        //End => send mail to all customers section

        //Start => send mail to selected customers section
        if ($request->mail_to === 'selected_messages') {
            $this->sendMailToSelectedMessages($request);
            return redirect()->back()->with('success', 'Reply Sent Successfully');
        }
        //End => send mail to selected customers section

        $request->validate([
            'message_id' => 'required|integer',
            'reply_email' => 'required|email',
            'reply_subject' => 'required',
            'reply_message' => 'required',
        ]);

        $reply_details = $request->only(['message_id', 'reply_email', 'reply_subject', 'reply_message', 'name']);

        Mail::to($reply_details['reply_email'])->send(new \App\Mail\ReplyMessage($reply_details));
        Reply::create($reply_details);

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

    protected function sendMailToAllMessages(Request $request)
    {
        $all_messages = Message::all();
        foreach ($all_messages as $message) {
            $details = [
                'message_id' => $message->id,
                'reply_email' => $message->email,
                'reply_subject' => $request->reply_subject,
                'reply_message' => $request->reply_message,
                'name' => $message->name
            ];
            Mail::to($details['reply_email'])->send(new \App\Mail\ReplyMessage($details));
            Reply::create($details);
        }
    }

    protected function sendMailToSelectedMessages(Request $request)
    {
        $messages = explode(',', $request->messages[0]);
        $messages = Message::whereIn('id', $messages)->get();
        foreach ($messages as $message) {
            $details = [
                'message_id' => $message->id,
                'reply_email' => $message->email,
                'reply_subject' => $request->reply_subject,
                'reply_message' => $request->reply_message,
                'name' => $message->name
            ];
            Mail::to($details['reply_email'])->send(new \App\Mail\ReplyMessage($details));
            Reply::create($details);
        }
    }

}
