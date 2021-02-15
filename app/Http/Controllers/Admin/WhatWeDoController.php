<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WhatWeDoRequest;
use App\Models\WhatWeDo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class WhatWeDoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:what_we_do create|what_we_do edit|what_we_do delete', ['only' => ['index']]);
        $this->middleware('permission:what_we_do create')->only(['create', 'store']);
        $this->middleware('permission:what_we_do edit')->only(['edit', 'update']);
        $this->middleware('permission:what_we_do delete')->only(['destroy']);
    }

    public function index()
    {
        $whatWeDos = WhatWeDo::latest()->get();
//        dd($whatWeDos);
        return view('admin.pages.what-we-do.index', compact('whatWeDos'));
    }


    public function create()
    {
        if (WhatWeDo::count() < 1) {
            return view('admin.pages.what-we-do.create');
        }
        abort(404);

    }


    public function store(WhatWeDoRequest $request)
    {
        DB::beginTransaction();

        try {
            WhatWeDo::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'youtube_link_1' => $request->youtube_link_1,
                'youtube_link_2' => $request->youtube_link_2,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('admin.what-we-do.index')->with('success', 'What We Do Successfully Created');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function edit(WhatWeDo $whatWeDo)
    {
        return view('admin.pages.what-we-do.edit', compact('whatWeDo'));
    }


    public function update(WhatWeDoRequest $request, WhatWeDo $whatWeDo)
    {
        DB::beginTransaction();

        try {

            $whatWeDo->update($request->all([
                'title',
                'sub_title',
                'youtube_link_1',
                'youtube_link_2',
                'description'
            ]));



            DB::commit();

            return redirect()->back()->with('success', 'What We Do Successfully Updated');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(WhatWeDo $whatWeDo)
    {
        DB::beginTransaction();

        try {

            $whatWeDo->delete();

            DB::commit();

            return redirect()->route('admin.what-we-do.index')->with('success', 'What We Do Successfully Deleted');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.what-we-do.index')->with('error', $exception->getMessage());
        }
    }
}
