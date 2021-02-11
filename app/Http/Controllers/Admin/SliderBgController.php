<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Models\SliderBg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderBgController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:background_image create|background_image edit|background_image delete', ['only' => ['index']]);
        $this->middleware('permission:background_image create')->only(['create', 'store']);
        $this->middleware('permission:background_image edit')->only(['edit', 'update']);
        $this->middleware('permission:background_image delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        //get all slider
        $sliders = SliderBg::latest();
        $sliders = $sliders->paginate(20);
        //Show All Slides
        return view('admin.pages.slider_bg.index', compact('sliders'));
    }

    public function create()
    {
        $slider = SliderBg::count();
        if ($slider >= 1) {
            abort(404);
        }
        return view('admin.pages.slider_bg.create');
    }

    public function store(Request $request)
    {
        $slider = SliderBg::count();
        if ($slider >= 1){
            abort(404);
        }

        $request->validate([
            'image' => 'required|image|max:5000'
        ]);

        DB::beginTransaction();

        try {

            $slider = SliderBg::create(['title' => Str::random()]);

            if ($request->file('image')) {
                $image = $request->file('image');
                $image_name = FileHandler::upload($image, 'slider_bg', ['width' => '2000', 'height' => '1500']);
            }

            $slider->image()->create([
                'url' => Storage::url($image_name),
                'base_path' => $image_name,
                'type' => 'slider_bg',
            ]);

            DB::commit();

            return redirect()->route('admin.slider-bg.index')->with('success', 'Background Image Successfully Created');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(SliderBg $sliderBg)
    {
        $slider = $sliderBg;
        return view('admin.pages.slider_bg.edit', compact('slider'));
    }

    public function update(Request $request, SliderBg $sliderBg)
    {
        $request->validate([
            'image' => 'nullable|image|max:5000'
        ]);

        $slider = $sliderBg;
        DB::beginTransaction();

        try {
            if ($request->file('image')) {
                $image = $request->file('image');
                $image_name = FileHandler::upload($image, 'slider_bg', ['width' => '2000', 'height' => '1500']);
                FileHandler::delete($slider->image->base_path);
            } else {
                $image_name = $slider->image->base_path;
            }
            $slider->image()->update([
                'url' => Storage::url($image_name),
                'base_path' => $image_name,
                'type' => 'slider_bg',
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Background Image Successfully Updated');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(SliderBg $sliderBg)
    {
        $slider = $sliderBg;
        DB::beginTransaction();

        try {

            FileHandler::delete($slider->image ? $slider->image->base_path : null);

            $slider->delete();

            DB::commit();

            return redirect()->route('admin.slider-bg.index')->with('success', 'Background Image Successfully Deleted');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.slider-bg.index')->with('error', $exception->getMessage());
        }
    }
}
