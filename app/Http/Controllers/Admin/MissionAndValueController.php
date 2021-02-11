<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\MissionAndValueRequest;
use App\Models\MissionAndValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MissionAndValueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:mission_and_value create|mission_and_value edit', ['only' => ['index']]);
        $this->middleware('permission:mission_and_value create')->only(['create', 'store']);
        $this->middleware('permission:mission_and_value edit')->only(['edit', 'update']);
    }

    public function index()
    {
        $mission_and_value = MissionAndValue::first();
        return view('admin.pages.mission-and-values.index', compact('mission_and_value'));
    }


    public function create()
    {
        if (MissionAndValue::count() < 1) {
            return view('admin.pages.mission-and-values.create');
        }
        abort(404);
    }


    public function store(MissionAndValueRequest $request)
    {
        DB::beginTransaction();

        try {
            $missionAndValue = MissionAndValue::create($request->only(['description_1', 'description_2']));
            if ($request->file('background_img')) {
                $image_path = FileHandler::upload($request->background_img, 'background', ['width' => 1920, 'height' => 450]);
                $missionAndValue->image()->create([ // save an image
                    'url' => Storage::url($image_path),
                    'base_path' => $image_path,
                    'type' => 'background',
                ]);
            }
            DB::commit();
            return redirect()->route('admin.mission_and_values.index')->with('success', 'Mission And Value Create Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }
    }


    public function show(MissionAndValue $missionAndValue)
    {
        abort(404);
    }


    public function edit(MissionAndValue $mission_and_value)
    {
        return view('admin.pages.mission-and-values.edit', compact('mission_and_value'));

    }


    public function update(MissionAndValueRequest $request, MissionAndValue $missionAndValue)
    {
        DB::beginTransaction();

        try {
            $missionAndValue->update($request->only(['description_1', 'description_2']));

            if ($request->file('background_img')) {
                $image_path = FileHandler::upload($request->background_img, 'background', ['width' => 1920, 'height' => 450]);
                if ($missionAndValue->image() == null) {
                    $missionAndValue->image()->create([
                        'url' => Storage::url($image_path),
                        'base_path' => $image_path,
                        'type' => 'background',
                    ]);
                } else {
                    FileHandler::delete($missionAndValue->image()->where('type', 'background')->first()->base_path ?? null);
                    $missionAndValue->image()->where('type', 'background')->first()->update([ // update an image
                        'url' => Storage::url($image_path),
                        'base_path' => $image_path,
                        'type' => 'background',
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.mission_and_values.index')->with('success', 'Mission And Value Update Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }
    }
}
