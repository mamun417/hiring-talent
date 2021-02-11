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
                    <strong>User Create</strong>
                </li>
            </ol>

        </div>
    </div>
    <div class="wrapper wrapper-content animated">
        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Create user for your company</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">

                                @include('admin.pages.users.element')

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger" type="submit">Chancel</a>
                                        <button class="btn btn-primary" type="submit">Save</button>
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
