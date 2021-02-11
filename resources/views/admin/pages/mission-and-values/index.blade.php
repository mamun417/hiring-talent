@extends('admin.layouts.app')

@section('title', 'Mission And Value')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.mission_and_values.index') }}">Mission And Value</a>
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
                    @if(\App\Models\MissionAndValue::count() < 1)
                        <div class="ibox-title">
                            <h5>All Mission And Value</h5>
                            @can('mission_and_value create')
                                <a href="{{ route('admin.mission_and_values.create') }}"
                                   class="btn btn-sm btn-primary pull-right">
                                    <i class="fa fa-plus"></i> <strong>Create</strong>
                                </a>
                            @endcan
                        </div>
                    @endif
                    <div class="ibox-content">
                        <div class="table-responsive m-t-md">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-left">Description 1</th>
                                    <th class="text-left">Description 2</th>
                                    <th class="text-left">Background Image</th>
                                    @canany(['mission_and_value edit'])
                                        <th class="text-center">Action</th>
                                    @endcanany
                                </tr>
                                </thead>

                                @if(isset($mission_and_value))
                                    <tbody>
                                    <tr>
                                        <td class="text-left">{!! @$mission_and_value->description_1 !!}</td>
                                        <td class="text-left">{!! @$mission_and_value->description_2 !!}</td>
                                        <td class="text-left">
                                            <img width="100%" height="100" src="{{ @$mission_and_value->image->url }}"
                                                 alt="Image">
                                        </td>
                                        @canany(['mission_and_value edit'])
                                            <td>
                                                <a href="{{ route('admin.mission_and_values.edit', @$mission_and_value->id) }}"
                                                   title="Edit"
                                                   class="btn btn-info btn-sm cus_btn">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            </td>
                                        @endcanany
                                    </tr>
                                    </tbody>
                                @endif
                            </table>

                            @if (\App\Models\MissionAndValue::count() !== 0)
                            @else
                                <div class="text-center">No mission and value found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


