@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')

    <div class="">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-3">
                <a href="#userList">
                    <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Total Users </span>
                            <h2 class="font-bold">{{ @$users->count() }}</h2>
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
                                <h2 class="font-bold">{{ @$messages->count() }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
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
                                <h2 class="font-bold">{{ @$talents->count() }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('admin.sliders.index') }}">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-image fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Total Sliders </span>
                                <h2 class="font-bold">{{ @$sliders->count() }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


@endsection
