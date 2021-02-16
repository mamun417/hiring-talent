@extends('admin.layouts.app')

@section('title', 'What We Do')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.what-we-do.index') }}">What We Do</a>
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
                        <h5>What We Do</h5>
                        @if(auth()->user()->can('what_we_do create'))
                            @if(@$whatWeDos->count() < 1)
                                <a href="{{ route('admin.what-we-do.create') }}"
                                   class="btn btn-sm btn-primary pull-right">
                                    <i class="fa fa-plus"></i> <strong>Create</strong>
                                </a>
                            @endif
                        @endif
                    </div>

                    <div class="ibox-content">
                        <div class="table-responsive m-t-md">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-left">Title</th>
                                    <th class="text-left">Subtitle</th>
                                    <th class="text-left">Youtube Link</th>
                                    <th class="text-left">Description</th>
                                    @canany(['what_we_do edit', 'what_we_do delete'])
                                        <th class="text-center" width="10%">Actions</th>
                                    @endcanany
                                </tr>
                                </thead>

                                <tbody>
                                @foreach(@$whatWeDos as $whatWeDo)
                                    <tr>
                                        <td>
                                            {{ @$whatWeDo->title }}
                                        </td>
                                        <td>
                                            {{ @$whatWeDo->sub_title }}
                                        </td>
                                        <td width="50">
                                            <a target="_blank" href="{{ @$whatWeDo->youtube_link_1 }}">{{ @$whatWeDo->youtube_link_1 }}</a>
                                            <a target="_blank" href="{{ @$whatWeDo->youtube_link_2 }}">{{ @$whatWeDo->youtube_link_2 }}</a>
                                        </td>
                                        <td class="text-left">
                                            {!! @$whatWeDo->description !!}
                                        </td>
                                        @canany(['what_we_do edit', 'what_we_do delete'])
                                            <td>
                                                @can('what_we_do edit')
                                                <a href="{{ route('admin.what-we-do.edit', @$whatWeDo->id)  }}"
                                                   title="Edit"
                                                   class="btn btn-info btn-sm cus_btn">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                @endcan

                                                @can('what_we_do delete')
                                                    <button onclick="deleteRow({{ @$whatWeDo->id }})"
                                                            href="JavaScript:void(0)"
                                                            title="Delete" class="btn btn-danger btn-sm cus_btn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <form id="row-delete-form{{ @$whatWeDo->id }}" method="POST"
                                                          class="d-none"
                                                          action="{{ route('admin.what-we-do.destroy', @$whatWeDo->id) }}">
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

                            @if (count(@$whatWeDos))
                            @else
                                <div class="text-center">No what we do found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
