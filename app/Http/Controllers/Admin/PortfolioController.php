<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:welcome create|welcome edit|welcome delete', ['only' => ['index']]);
        $this->middleware('permission:welcome create')->only(['create', 'store']);
        $this->middleware('permission:welcome edit')->only(['edit', 'update']);
        $this->middleware('permission:welcome delete')->only(['destroy']);
    }


    public function index()
    {
        $portfolio = Portfolio::first();
        return view('admin.pages.portfolios.index', compact('portfolio'));
    }


    public function create()
    {
        if (Portfolio::count() < 1) {
            return view('admin.pages.portfolios.create');
        }
        abort(404);
    }


    public function store(PortfolioRequest $request)
    {
        DB::beginTransaction();

        try {
            $images = [
                [
                    'type' => 'one',
                    'image' => $request->image_1
                ], [
                    'type' => 'two',
                    'image' => $request->image_2
                ], [
                    'type' => 'three',
                    'image' => $request->image_3
                ], [
                    'type' => 'four',
                    'image' => $request->image_4
                ],
            ];
            $portfolio = Portfolio::create($request->only(['title', 'description', 'sub_title']));

            // upload every image
            foreach ($images as $image) {
                if ($image['image']) {
                    $image_path = FileHandler::upload($image['image'], 'portfolios', ['width' => 255, 'height' => 207]);

                    $portfolio_exist = $portfolio->images()->where('type', $image['type'])->first();
                    if ($portfolio_exist) {
                        FileHandler::delete(@$portfolio_exist->base_path);
                        $portfolio_exist->delete();
                    }
                    $portfolio->images()->create([ // save an image
                        'url' => Storage::url($image_path),
                        'base_path' => $image_path,
                        'type' => $image['type'],
                    ]);
                }
            }


            DB::commit();
            return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio Create Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }
    }


    public function show(Portfolio $portfolio)
    {
        abort(404);
    }


    public function edit(Portfolio $portfolio)
    {
        return view('admin.pages.portfolios.edit', compact('portfolio'));
    }


    public function update(PortfolioRequest $request, Portfolio $portfolio)
    {
        DB::beginTransaction();

        try {
            $images = [
                [
                    'type' => 'one',
                    'image' => $request->image_1
                ], [
                    'type' => 'two',
                    'image' => $request->image_2
                ], [
                    'type' => 'three',
                    'image' => $request->image_3
                ], [
                    'type' => 'four',
                    'image' => $request->image_4
                ],
            ];

            $portfolio->update($request->only(['title', 'description', 'sub_title']));

            // upload every image
            foreach ($images as $image) {
                if ($image['image']) {
                    $image_path = FileHandler::upload($image['image'], 'portfolios', ['width' => 255, 'height' => 207]);

                    $portfolio_exist = $portfolio->images()->where('type', $image['type'])->first();
                    if ($portfolio_exist) {
                        FileHandler::delete(@$portfolio_exist->base_path);
                        $portfolio_exist->delete();
                    }
                    $portfolio->images()->create([ // save an image
                        'url' => Storage::url($image_path),
                        'base_path' => $image_path,
                        'type' => $image['type'],
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio Update Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }

    }

    public function destroy(Portfolio $portfolio)
    {
        foreach ($portfolio->images as $image) {
            FileHandler::delete($image->base_path);
        }
        $portfolio->images()->delete();

        if ($portfolio->delete()) {
            return redirect()->back()->with('success', 'Portfolio Deleted Successfully');
        }
    }
}
