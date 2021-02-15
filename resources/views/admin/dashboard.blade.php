@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')

    <div class="">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-3">
                <a href="{{ route('admin.admins.index') }}">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Total Admins </span>
                                <h2 class="font-bold">{{ @$admins }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('admin.users.index') }}">
                    <div class="widget style1 bg-danger">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Total Users </span>
                                <h2 class="font-bold">{{ @$users }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('admin.messages.index') }}">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-envelope-o fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Total messages </span>
                                <h2 class="font-bold">{{ @$messages }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 bg-secondary text-white">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-reply-all fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Total Message Replied</span>
                            <h2 class="font-bold">{{ @$total_message_replied }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('admin.talents.index') }}">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-deaf fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Total Talents </span>
                                <h2 class="font-bold">{{ @$talents }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 bg-success">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-mail-reply-all fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Total Talent Replied </span>
                            <h2 class="font-bold">{{ @$total_talent_replied }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('admin.sliders.index') }}">
                    <div class="widget style1 bg-dark text-white">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-image fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Total Sliders </span>
                                <h2 class="font-bold">{{ @$sliders }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('admin.featured-brands.index') }}">
                    <div class="widget style1 bg-danger">
                        <div class="row">
                            <div class="col-3">
                                <i class="fa fa-braille fa-4x"></i>
                            </div>
                            <div class="col-9 text-right">
                                <span> Featured Collaborative Brands </span>
                                <h2 class="font-bold">{{ @$featured_brands }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


@endsection
