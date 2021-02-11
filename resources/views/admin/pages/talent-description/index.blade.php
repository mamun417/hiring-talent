@extends('admin.layouts.app')

@section('title', 'Talent Description')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.talent_descriptions.index') }}">Talent Descriptions</a>
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
                        <h5>All Talent Description</h5>
                        @can('talent_description create')
                            @if(\App\Models\TalentDescription::count() < 1)
                                <a href="{{ route('admin.talent_descriptions.create') }}"
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
                                    <th class="text-left">Title</th>
                                    <th class="text-left">Description</th>
                                    @can('talent_description edit')
                                        <th class="text-center">Action</th>
                                    @endcan
                                </tr>
                                </thead>
                                @if(isset($talent_description))
                                    <tbody>
                                    <tr>
                                        <td class="text-left">{{ ucfirst(Str::limit(@$talent_description->title)) }}</td>
                                        <td class="text-left">{!! @$talent_description->description !!}</td>
                                        @can('talent_description edit')
                                            <td>
                                                <a href="{{ route('admin.talent_descriptions.edit', @$talent_description->id) }}"
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

                            @if (\App\Models\TalentDescription::count() !== 0)
                            @else
                                <div class="text-center">No talent description found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


