@extends('admin.layouts.app')

@section('title', 'Background Image')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.slider-bg.index') }}">Background Image</a>
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
                        <h5>All Background Image</h5>
                        @can('background_image create')
                            @if($sliders->count() <= 0)
                                <a href="{{ route('admin.slider-bg.create') }}"
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
                                    <th class="text-left">Image</th>
                                    @canany(['background_image edit', 'background_image delete'])
                                        <th class="text-center" width="10%">Actions</th>
                                    @endcanany
                                </tr>
                                </thead>

                                <tbody>
                                @foreach(@$sliders as $slider)
                                    <tr>
                                        <td>
                                            <img width="100" height="50" src="{{ @$slider->image->url }}"
                                                 alt="Slide Image">
                                        </td>
                                        @canany(['background_image edit', 'background_image delete'])
                                            <td>
                                                @can('background_image edit')
                                                    <a href="{{ route('admin.slider-bg.edit',['slider_bg' =>  @$slider->id])  }}"
                                                       title="Edit"
                                                       class="btn btn-info btn-sm cus_btn">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                @endcan
                                                @can('background_image delete')
                                                    <button onclick="deleteRow({{ @$slider->id }})"
                                                            href="JavaScript:void(0)"
                                                            title="Delete" class="btn btn-danger btn-sm cus_btn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <form id="row-delete-form{{ @$slider->id }}" method="POST"
                                                          class="d-none"
                                                          action="{{ route('admin.slider-bg.destroy', @$slider->id) }}">
                                                        @method('DELETE')
                                                        @csrf()
                                                    </form>
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if (count(@$sliders))
                                {{ @$sliders->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}
                            @else
                                <div class="text-center">No Background image found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


