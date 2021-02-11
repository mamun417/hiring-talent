@extends('layouts.app')
@section('title', 'All Featured Brands')
@section('style')
<style>
    .image-area {
        padding: 0px !important;
    }

    .heading {
        margin-top: 40px;
        text-align: center;
        color: #0d8ef2;
    }
</style>
@section('content')
<div class="heading">
    <div class="container">
        <h2>FEATURED COLABORATIVE BRANDERS</h2>
    </div>
</div>

<div class="container">
    <div class="image-area mt-5">
        <div class="row">
            @foreach(@$featuredBrands as $brand)
            <div class="col-12 col-md-3 col-lg-3 mb-5">
                <div class="card">
                    <img class="card-img-top" src="{{ @$brand->image->url }}" alt="Card image cap">
                    <hr class="m-0">
                    <div class="card-body">
                        <h5 class="card-title">{{ \Illuminate\Support\Str::limit(@$brand->name, 15) }}</h5>
                        <p class="card-text mt-3">{{ \Illuminate\Support\Str::limit(@$brand->title, 42) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
