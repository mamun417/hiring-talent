<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use DB;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:contact create|contact edit', ['only' => ['index']]);
        $this->middleware('permission:contact create')->only(['create', 'store']);
        $this->middleware('permission:contact edit')->only(['edit', 'update']);
    }

    public function index()
    {
        $contact = Contact::first();
        return view('admin.pages.settings.contact.index', compact('contact'));
    }

    public function create()
    {
        if (Contact::count() < 1) {
            return view('admin.pages.settings.contact.create');
        }
        abort(404);
    }

    public function store(ContactRequest $request)
    {
        try {
            $onlyGo = $request->only([
                'address', 'phone_1', 'phone_2', 'telephone', 'email',
                'fax'
            ]);

            Contact::create($onlyGo);

            DB::commit();
            return redirect()->route('admin.contacts.index')->with('success', 'Contact Create Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(Contact $contact)
    {
        return view('admin.pages.settings.contact.edit', compact('contact'));
    }


    public function update(ContactRequest $request, Contact $contact)
    {
        DB::beginTransaction();

        try {
            $onlyGo = $request->only([
                'address', 'phone_1', 'phone_2', 'telephone', 'email',
                'fax'
            ]);

            $contact->update($onlyGo);

            DB::commit();
            return redirect()->back()->with('success', 'Contact Update Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
