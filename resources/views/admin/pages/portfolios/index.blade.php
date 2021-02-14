@extends('admin.layouts.app')

@section('title', 'Welcomes')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.portfolios.index') }}">Welcomes</a>
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
                        <h5>All Welcomes</h5>
                        @can('welcome create')
                            @if(\App\Models\Portfolio::count() < 1)
                                <a href="{{ route('admin.portfolios.create') }}"
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
                                    <th class="text-left">Sub Title</th>
                                    <th class="text-left">Images</th>
                                    <th class="text-left">Description</th>
                                    @canany(['welcome edit', 'welcome delete'])
                                        <th width="100" class="text-center">Actions</th>
                                    @endcanany
                                </tr>
                                </thead>

                                @if(isset($portfolio))
                                    <tbody>
                                    <tr>
                                        <td class="text-left">{{ ucfirst(Str::limit(@$portfolio->title, 50)) }}</td>
                                        <td class="text-left">{{ ucfirst(Str::limit(@$portfolio->sub_title, 50)) }}</td>
                                        <td>
                                            @if(@$portfolio)
                                                <div class="d-flex flex-column">
                                                    @forelse(@$portfolio->images as $image)
                                                        <img width="100%" height="50" src="{{ @$image->url }}"
                                                             alt="Image">
                                                        <br>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-left">{!! @$portfolio->description !!}</td>
                                        @canany(['welcome edit', 'welcome delete'])
                                            <td width="100">
                                                @can('welcome edit')
                                                    <a href="{{ route('admin.portfolios.edit', @$portfolio->id) }}"
                                                       title="Edit"
                                                       class="btn btn-info btn-sm cus_btn mb-sm-0 mb-2">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                @endcan
                                                @can('welcome delete')
                                                    <button onclick="deleteRow({{ @$portfolio->id }})"
                                                            href="JavaScript:void(0)"
                                                            title="Delete" class="btn btn-danger btn-sm cus_btn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <form id="row-delete-form{{ @$portfolio->id }}" method="POST"
                                                          class="d-none"
                                                          action="{{ route('admin.portfolios.destroy', @$portfolio->id) }}">
                                                        @method('DELETE')
                                                        @csrf()
                                                    </form>
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                    </tbody>
                                @endif
                            </table>

                            @if (\App\Models\Portfolio::count() !== 0)
                            @else
                                <div class="text-center">No welcome found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


