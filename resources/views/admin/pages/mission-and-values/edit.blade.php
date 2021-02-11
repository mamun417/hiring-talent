@extends('admin.layouts.app')

@section('title', 'Mission And Value Update')

@section('content')

    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.mission_and_values.index') }}">Mission And Values</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form action="{{ route('admin.mission_and_values.update', @$mission_and_value->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Update Exist Mission And Value</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">

                                @include('admin.pages.mission-and-values.element')

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.mission_and_values.index') }}" class="btn btn-danger" type="submit">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Save Change</button>
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
