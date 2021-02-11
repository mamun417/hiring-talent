<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:site_setting create|site_setting edit', ['only' => ['index']]);
        $this->middleware('permission:site_setting create')->only(['create', 'store']);
        $this->middleware('permission:site_setting edit')->only(['edit', 'update']);
    }

    public function index()
    {
        $setting = Setting::first();
        return view('admin.pages.settings.index', compact('setting'));
    }

    public function create()
    {
        if (Setting::count() < 1) {
            return view('admin.pages.settings.create');
        }
        abort(404);
    }


    public function store(SettingRequest $request)
    {
        DB::beginTransaction();

        try {
            $onlyGo = $request->only(['site_name']);
            $setting = Setting::create($onlyGo);
            if ($request->file('logo')) {
                $image = $request->file('logo');
                $logo_name = FileHandler::upload($image, 'logos', ['width' => '350', 'height' => '89']);

                $setting->image()->create([
                    'url' => Storage::url($logo_name),
                    'base_path' => $logo_name,
                    'type' => 'logo',
                ]);
            }

            DB::commit();
            return redirect()->route('admin.settings.index')->with('success', 'Setting Create Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }
    }


    public function edit(Setting $setting)
    {
        return view('admin.pages.settings.edit', compact('setting'));
    }


    public function update(SettingRequest $request, Setting $setting)
    {
        DB::beginTransaction();

        try {
            if ($request->file('logo')) {
                $image = $request->file('logo');
                $logo_name = FileHandler::upload($image, 'logos', ['width' => '350', 'height' => '89']);

                if ($setting->image == null) {
                    $setting->image()->create([
                        'url' => Storage::url($logo_name),
                        'base_path' => $logo_name,
                        'type' => 'logo',
                    ]);
                } else {
                    FileHandler::delete($setting->image()->where('type', 'logo')->first()->base_path ?? null);
                    $setting->image()->where('type', 'logo')->first()->update([
                        'url' => Storage::url($logo_name),
                        'base_path' => $logo_name,
                        'type' => 'logo',
                    ]);
                }
            }

            $onlyGo = $request->only(['site_name']);
            $setting->update($onlyGo);

            DB::commit();
            return redirect()->back()->with('success', 'Social Update Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

}
