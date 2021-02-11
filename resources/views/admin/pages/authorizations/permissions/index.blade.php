@extends('admin.layouts.app')

@section('title', 'Permissions')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.permissions.index') }}">Permissions</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>lists</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>All Permissions</h5>
{{--                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary pull-right">--}}
{{--                            <i class="fa fa-plus"></i> <strong>Create</strong>--}}
{{--                        </a>--}}
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{ route('admin.permissions.index')}}" method="get"
                                      role="form">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="perPage" class="control-label">Records Per Page</label>
                                                </div>
                                                <div class="col-md-4 pr-0 responsive_p_r_15">
                                                    <select name="perPage" id="perPage" onchange="submit()"
                                                            class="input-sm form-control custom_field_height">
                                                        <option value="10"{{ request('perPage') == 10 ? ' selected' : '' }}>
                                                            10
                                                        </option>
                                                        <option value="25"{{ request('perPage') == 25 ? ' selected' : '' }}>
                                                            25
                                                        </option>
                                                        <option value="50"{{ request('perPage') == 50 ? ' selected' : '' }}>
                                                            50
                                                        </option>
                                                        <option value="100"{{ request('perPage') == 100 ? ' selected' : '' }}>
                                                            100
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 pl-sm-1 pr-sm-1 responsive_p_t_f_5">
                                                    <div class="float-left input-group">
                                                        <input name="keyword" type="text" value="{{ request('keyword') }}"
                                                               class="input-sm form-control" placeholder="Search Here">
                                                        <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-sm btn-primary custom_field_height"> Go!</button>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 p-0 responsive_p_l_15">
                                                <span>
                                                    <a href="{{ route('admin.permissions.index') }}"
                                                       class="btn btn-default btn-sm custom_field_height">Reset
                                                    </a>
                                                </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="table-responsive m-t-md">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">Serial</th>
                                    <th class="text-center">Name</th>
{{--                                    <th class="text-center">Action</th>--}}
                                </tr>
                                </thead>

                                <tbody>
                                @foreach(@$permissions as  $key => $permission)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</td>
{{--                                        <td>--}}

{{--                                            <a href="{{ route('admin.permissions.edit', @$permission->id)  }}" title="Edit"--}}
{{--                                               class="btn btn-info btn-sm cus_btn">--}}
{{--                                                <i class="fa fa-pencil-square-o"></i>--}}
{{--                                            </a>--}}

{{--                                            <button onclick="deleteRow({{ @$permission->id }})" href="JavaScript:void(0)"--}}
{{--                                                    title="Delete" class="btn btn-danger btn-sm cus_btn">--}}
{{--                                                <i class="fa fa-trash"></i>--}}
{{--                                            </button>--}}
{{--                                            <form id="row-delete-form{{ @$permission->id }}" method="POST" class="d-none"--}}
{{--                                                  action="{{ route('admin.permissions.destroy', @$permission->id) }}">--}}
{{--                                                @method('DELETE')--}}
{{--                                                @csrf()--}}
{{--                                            </form>--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if (count(@$permissions))
                                {{ @$permissions->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}
                            @else
                                <div class="text-center">No permissions found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


