<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\ProductHelper;
use App\Models\FeaturedBrand;
use App\Models\MissionAndValue;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SliderBg;
use App\Models\WhatWeDo;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $sliders = Slider::status()->with('image')->latest()->get();
        $featured_brands = FeaturedBrand::latest()->paginate(4);
        $portfolio = Portfolio::first();
        $missionAndValue = MissionAndValue::first();
        $whatWeDo = WhatWeDo::first();

        return view('home', compact('sliders','missionAndValue', 'featured_brands', 'portfolio', 'whatWeDo'));
    }

    public function allFeaturedBrands(){
        $featuredBrands = FeaturedBrand::latest()->get();
        return view('pages.all-featured-brands.all-featured-brands', compact('featuredBrands'));
//        dd($featuredBrands);
    }
}
