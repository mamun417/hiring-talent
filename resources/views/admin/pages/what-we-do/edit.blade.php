@extends('admin.layouts.app')

@section('title', 'What We Do Edit')

@section('content')

    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.what-we-do.index') }}">What We Do</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form action="{{ route('admin.what-we-do.update', @$whatWeDo->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Update What We Do</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">

                                @include('admin.pages.what-we-do.element')

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.what-we-do.index') }}" class="btn btn-danger" type="submit">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
