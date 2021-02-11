@extends('admin.layouts.app')

@section('title', 'Role Edit')

@section('content')

    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.roles.index') }}">Role</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form action="{{ route('admin.roles.update', @$role->id) }}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Edit Role</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">

                                @include('admin.pages.authorizations.roles.element')

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.roles.index') }}" class="btn btn-danger" type="submit">Cancel</a>
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
