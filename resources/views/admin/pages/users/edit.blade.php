@extends('admin.layouts.app')
@section('title', 'User')

@section('content')
    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>user Edit</strong>
                </li>
            </ol>

        </div>
    </div>
    <div class="wrapper wrapper-content animated">
        <form action="{{ route('admin.users.update', @$user->id) }}" method="post" enctype="multipart/form-data">
           @method("patch")
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Edit user for your company</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">

                                @include('admin.pages.users.element')

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger" type="submit">Chancel</a>
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

@push('script')

@endpush
