<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:message show', ['only' => ['index']]);
        $this->middleware('permission:message show')->only(['show']);
    }

    public function index(Request $request){
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all Messages
        $messages = Message::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $messages = $messages->where('email', 'like', $keyword)
                ->orWhere('name', 'like', $keyword)
                ->orWhere('message', 'like', $keyword)
                ->orWhere('subject', 'like', $keyword)
            ;
        }

        $messages = $messages->paginate($perPage);
        //Show All Messages
        return view('admin.pages.messages.index', compact('messages'));
    }

    // message show admin panel
    public function show(Message $message){
        return view('admin.pages.messages.details', compact('message'));
    }

    public function destroy(Message $message)
    {
        {
            $message->delete();
            return redirect()->back()->with('success', 'Message Deleted Successfully');
        }
    }
}
