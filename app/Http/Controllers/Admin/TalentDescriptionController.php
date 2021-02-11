<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\TalentDescriptionRequest;
use App\Models\TalentDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TalentDescriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:talent_description create|talent_description edi', ['only' => ['index']]);
        $this->middleware('permission:talent_description create')->only(['create', 'store']);
        $this->middleware('permission:talent_description edit')->only(['edit', 'update']);
    }

    public function index()
    {
        $talent_description = TalentDescription::first();
        return view('admin.pages.talent-description.index', compact('talent_description'));
    }


    public function create()
    {
        if (TalentDescription::count() < 1) {
            return view('admin.pages.talent-description.create');
        }
        abort(404);
    }


    public function store(TalentDescriptionRequest $request)
    {
        DB::beginTransaction();

        try {
            TalentDescription::create($request->only(['description', 'title']));

            DB::commit();
            return redirect()->route('admin.talent_descriptions.index')->with('success', 'Talent Description Create Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }
    }


    public function show(TalentDescription $TalentDescription)
    {
        abort(404);
    }


    public function edit(TalentDescription $talent_description)
    {
        return view('admin.pages.talent-description.edit', compact('talent_description'));

    }

    public function update(TalentDescriptionRequest $request, TalentDescription $TalentDescription)
    {
        DB::beginTransaction();

        try {
            $TalentDescription->update($request->only(['description', 'title']));

            DB::commit();
            return redirect()->route('admin.talent_descriptions.index')->with('success', 'Talent Description Update Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }
    }
}
