<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\SocialRequest;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:social create|social edit|social delete|social status', ['only' => ['index']]);
        $this->middleware('permission:social create')->only(['create', 'store']);
        $this->middleware('permission:social edit')->only(['edit', 'update']);
        $this->middleware('permission:social delete')->only(['destroy']);
        $this->middleware('permission:social status')->only(['changeStatus']);
    }

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        $socials = Social::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $socials = $socials->where('name', 'like', $keyword)
                ->orWhere('link', 'like', $keyword)
                ->orWhere('icon', 'like', $keyword)
            ;
        }

        $socials = $socials->paginate($perPage);

        return view('admin.pages.socials.index', compact('socials'));
    }


    public function create()
    {
       return view('admin.pages.socials.create');
    }


    public function store(SocialRequest $request)
    {
        DB::beginTransaction();

        try {
            /*'status' => $request->status ? true : false,*/

            $request['status'] = $request->status ? true : false;
            $request['icon'] = strtolower($request->icon);
            $onlyGo = $request->only(['name', 'link', 'icon', 'status']);

            Social::create($onlyGo);

            DB::commit();
            return redirect()->back()->with('success', 'Social Successfully Created');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function show(Social $social)
    {
        //
    }


    public function edit(Social $social)
    {
        return view('admin.pages.socials.edit', compact('social'));
    }


    public function update(SocialRequest $request, Social $social)
    {
        DB::beginTransaction();

        try {
            $request['status'] = $request->status ? true : false;
            $request['icon'] = strtolower($request->icon);
            $onlyGo = $request->only(['name', 'link', 'icon', 'status']);

            $social->update($onlyGo);

            DB::commit();
            return redirect()->back()->with('success', 'Social Successfully Updated');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(Social $social)
    {
        {
            $social->delete();
            return redirect()->back()->with('success', 'Social Successfully Deleted');
        }
    }

    public function changeStatus(Social $social)
    {
        $social->update(['status' => !$social->status]);
        return response()->json(['status' => true]);
    }
}
