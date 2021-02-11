@extends('layouts.app')
@section('title', 'Home')
@section('style')
<style>
    .mission-area {
        background-image: url({{ @$missionAndValue->image->url }}) !important;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        padding: 100px 0px;
        color: white;
    }

    .video_section .iframe-container {
        position: relative;
        text-align: center !important;
        width: 100%;
        padding-bottom: 56.25%;
        height: 0;
    }

    .video_section .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>
@endsection
@section('content')

<div class="welcome-area" id="wlc">
    <div class="container" id="about">
        <h2>WELCOME</h2>
    </div>
</div>
<!--Portfolio Section-->
<div class="portfolio-section">
    <div class="container">
        <div class="row">
            <div class="text-area col-lg-6 order-lg-1">
                <h1 class="mb-0 mt-0">{{ ucfirst(@$portfolio->title) }}</h1>
                <h2>{{ ucfirst(@$portfolio->sub_title) }}</h2>
                <p>{!! @$portfolio->description !!}</p>
            </div>
            <div class="col-lg-6 order-lg-0">
                <div class="row">
                    @if($portfolio)
                    @foreach($portfolio->images as $image)
                    <div class="col-md-6">
                        <img class="img-fluid" src="{{ @$image->url }}" alt="Image" />
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="service-section">
    <div class="container">
        <div class="service-area row">
            <div class="into-area col-lg-6 mb-5">
                <h2>WHAT WE DO</h2>
                <h1 class="my-0 text-left">{{ @$whatWeDo->title }}</h1>
                <h2 class="text-left mb-3" style="font-size: 30px; font-weight: 600;">{{ @$whatWeDo->sub_title }}</h2>
                <div class="service-text">
                    {!! @$whatWeDo->description !!}
                </div>
            </div>
            <div class="video-area col-lg-6">
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom: 40px;">
                        <div class="video_section">
                            <div class="iframe-container">
                                <iframe width="560" height="315" src="{{ @$whatWeDo->youtube_link_1 }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="video_section">
                            <div class="iframe-container">
                                <iframe width="560" height="315" src="{{ @$whatWeDo->youtube_link_2 }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="welcome-area">
    <div class="container">
        <h2>FEATURED COLABORATIVE BRANDERS</h2>
    </div>
</div>
<div class="container">
    <div class="">
        <div class="row mt-5">
            @foreach(@$featured_brands->take(4) as $brand)
            <div class="col-12 col-md-3 col-lg-3">
                <div class="card mb-4">
                    <img class="card-img-top" src="{{ @$brand->image->url }}" alt="Card image cap">
                    <hr class="m-0">
                    <div class="card-body">
                        <h5 class="card-title">{{ \Illuminate\Support\Str::limit(@$brand->name, 15) }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit(@$brand->title, 42) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @if(\App\Models\FeaturedBrand::count() > 4)
    <div class="row">
        <div class="col-sm-12">
            <div class="float-right mb-5">
                <a class="btn btn-primary text-white px-5 rounded-pill float-right"
                    href="{{ route('featured-brands-more') }}">See More</a>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="welcome2-area col-12">
    <div class="container">
        <h2>MISSION & VALUES</h2>
    </div>
</div>

<div class="mission-area">
    <div class="mission-blur">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6 mb-4 text-editor">
                    {!! @$missionAndValue->description_1 !!}
                </div>
                <div class="col-12 col-md-6 col-lg-6 mb-4 text-editor">
                    {!! @$missionAndValue->description_2 !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
