<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Models\FeaturedBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FeaturedBrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:featured_brand create|featured_brand edit|featured_brand delete', ['only' => ['index']]);
        $this->middleware('permission:featured_brand create')->only(['create', 'store']);
        $this->middleware('permission:featured_brand edit')->only(['edit', 'update']);
        $this->middleware('permission:featured_brand delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        $featured_brands = FeaturedBrand::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $featured_brands = $featured_brands->where('name', 'like', $keyword)
                ->orWhere('title', 'like', $keyword);
        }

        $featured_brands = $featured_brands->paginate($perPage);

        return view('admin.pages.featured-brands.index', compact('featured_brands'));
    }


    public function create()
    {
        return view('admin.pages.featured-brands.create');
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $featured_brand = FeaturedBrand::create($request->only(['name', 'title']));

            if ($request->file('featured_brands_image')) {
                $image = $request->file('featured_brands_image');
                $image_name = FileHandler::upload($image, 'featured_brands', ['width' => '255', 'height' => '300']);
            }

            $featured_brand->image()->create([
                'url' => Storage::url($image_name),
                'base_path' => $image_name,
            ]);

            DB::commit();

            return redirect()->route('admin.featured-brands.index')->with('success', 'Featured Brand Successfully Created');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.featured-brands.index')->with('error', $exception->getMessage());
        }
    }


    public function show(FeaturedBrand $featuredBrand)
    {
        abort(404);
    }


    public function edit(FeaturedBrand $featuredBrand)
    {
        return view('admin.pages.featured-brands.edit', compact('featuredBrand'));
    }


    public function update(Request $request, FeaturedBrand $featuredBrand)
    {
        DB::beginTransaction();

        try {

            $featuredBrand->update($request->only(['name', 'title']));

            if ($request->file('featured_brands_image')) {
                $image = $request->file('featured_brands_image');
                $image_name = FileHandler::upload($image, 'featured_brands', ['width' => '255', 'height' => '300']);

                FileHandler::delete(@$featuredBrand->image->base_path);
            } else {
                $image_name = $featuredBrand->image->base_path;
            }

            $featuredBrand->image()->update([
                'url' => Storage::url($image_name),
                'base_path' => $image_name,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Featured Brand Successfully Update');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(FeaturedBrand $featuredBrand)
    {
        DB::beginTransaction();

        try {

            FileHandler::delete(@$featuredBrand->image->base_path);

            $featuredBrand->delete();

            DB::commit();

            return redirect()->route('admin.featured-brands.index')->with('success', 'Featured Brand Successfully Deleted');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.featured-brands.index')->with('error', $exception->getMessage());
        }
    }
}
