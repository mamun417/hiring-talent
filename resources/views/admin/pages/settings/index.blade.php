@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Index</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Setting</h5>
                        @can('site_setting create')
                            @if(\App\Models\Setting::count() < 1)
                                <a href="{{ route('admin.settings.create') }}"
                                   class="btn btn-sm btn-primary pull-right">
                                    <i class="fa fa-plus"></i> <strong>Create</strong>
                                </a>
                            @endif
                        @endcan
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive m-t-md">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-left">Site Name</th>
                                    <th>Logo</th>
                                    @can('site_setting edit')
                                        <th class="text-center" width="8%">Actions</th>
                                    @endcan
                                </tr>
                                </thead>
                                @if(isset($setting))
                                    <tbody>
                                    <tr>
                                        <td class="text-left">{{ ucfirst(Str::limit(@$setting->site_name, 50)) }}</td>
                                        <td>
                                            <img width="100" height="50"
                                                 src="{{ isset($setting) ? @$setting->image()->where('type', 'logo')->first()->url : '' }}"
                                                 alt="Logo">
                                        </td>
                                        @can('site_setting edit')
                                            <td>
                                                <a href="{{ route('admin.settings.edit', @$setting->id)  }}"
                                                   title="Edit"
                                                   class="btn btn-info btn-sm cus_btn">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>
                                    </tbody>
                                @endif
                            </table>
                            @if(!isset($setting))
                                <div class="text-center">No setting found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
