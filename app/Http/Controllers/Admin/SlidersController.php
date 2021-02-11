<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SlidersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:slider create|slider edit|slider delete|slider status', ['only' => ['index']]);
        $this->middleware('permission:slider create')->only(['create', 'store']);
        $this->middleware('permission:slider edit')->only(['edit', 'update']);
        $this->middleware('permission:slider delete')->only(['destroy']);
        $this->middleware('permission:slider status')->only(['changeStatus']);
    }

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all slider
        $sliders = Slider::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $sliders = $sliders->where('title', 'like', $keyword);
        }

        $sliders = $sliders->paginate($perPage);

        //Show All Slides
        return view('admin.pages.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.pages.slider.create');
    }

    public function store(SliderRequest $request)
    {
        DB::beginTransaction();

        try {

            $slider = Slider::create([
                'title' => $request->title,
                'text' => $request->text,
                'status' => $request->status ? true : false,
            ]);

            if ($request->file('image')) {
                $image = $request->file('image');
                $image_name = FileHandler::upload($image, 'sliders', ['width' => '1200', 'height' => '500']);
            }

            $slider->image()->create([
                'url' => Storage::url($image_name),
                'base_path' => $image_name,
                'type' => 'lg',
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Slider Successfully Created');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(Slider $slider)
    {
        return view('admin.pages.slider.edit', compact('slider'));
    }

    public function update(SliderRequest $request, Slider $slider)
    {
        DB::beginTransaction();

        try {

            $slider->update([
                'title' => $request->title,
                'text' => $request->text,
                'status' => $request->status ? true : false,
            ]);

            if ($request->file('image')) {
                $image = $request->file('image');
                $image_name = FileHandler::upload($image, 'sliders', ['width' => '1200', 'height' => '500']);

                FileHandler::delete($slider->image->base_path);

            } else {
                $image_name = $slider->image->base_path;
            }

            $slider->image()->update([
                'url' => Storage::url($image_name),
                'base_path' => $image_name,
                'type' => 'lg',
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Slider Successfully Updated');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Slider $slider)
    {
        DB::beginTransaction();

        try {

            FileHandler::delete($slider->image->base_path);

            $slider->delete();

            DB::commit();

            return redirect()->route('admin.sliders.index')->with('success', 'Slider Successfully Deleted');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.sliders.index')->with('error', $exception->getMessage());
        }
    }

    public function changeStatus(Slider $slider)
    {
        $slider->update(['status' => !$slider->status]);
        return response()->json(['status' => true]);
    }
}
