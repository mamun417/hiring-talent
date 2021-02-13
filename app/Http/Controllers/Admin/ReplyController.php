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
        $this->middleware('permission:reply message reply')->only(['store']);
        $this->middleware('permission:reply show')->only(['messageReplies']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index(Request $request)
//    {
//        $perPage = $request->perPage ?: 10;
//        $keyword = $request->keyword;
//
//        $replies = Reply::latest();
//
//        if ($keyword) {
//            $keyword = '%' . $keyword . '%';
//            $replies = $replies->where('name', 'like', $keyword)
//                ->orWhere('link', 'like', $keyword)
//                ->orWhere('icon', 'like', $keyword)
//            ;
//        }
//
//        $replies = $replies->paginate($perPage);
//
//        return view('admin.pages.socials.index', compact('replies'));
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyRequest $request)
    {
        $reply_details= $request->only(['message_id', 'reply_email', 'reply_subject', 'reply_message', 'name']);

        Mail::to($reply_details['reply_email'])->send(new \App\Mail\ReplyMessage($reply_details));
        Reply::create($reply_details);

        DB::commit();
        return redirect()->back()->with('success', 'Reply Sent Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        {
            $reply->delete();
            return redirect()->back()->with('success', 'Reply Deleted Successfully');
        }
    }

    public function messageReplies(Message $message){
        $replies = $message->replies()->paginate(10);
        return view("admin.pages.messages.replies", compact('replies', 'message'));
    }
}
