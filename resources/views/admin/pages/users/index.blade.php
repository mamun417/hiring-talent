@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Users</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Users</h5>
                        {{--                        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary pull-right">--}}
                        {{--                            <i class="fa fa-plus"></i> <strong>Create</strong>--}}
                        {{--                        </a>--}}
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{ route('admin.users.index')}}" method="get"
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
                                                        <option
                                                            value="10"{{ request('perPage') == 10 ? ' selected' : '' }}>
                                                            10
                                                        </option>
                                                        <option
                                                            value="25"{{ request('perPage') == 25 ? ' selected' : '' }}>
                                                            25
                                                        </option>
                                                        <option
                                                            value="50"{{ request('perPage') == 50 ? ' selected' : '' }}>
                                                            50
                                                        </option>
                                                        <option
                                                            value="100"{{ request('perPage') == 100 ? ' selected' : '' }}>
                                                            100
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 pl-sm-1 pr-sm-1 responsive_p_t_f_5">
                                                    <div class="float-left input-group">
                                                        <input name="keyword" type="text"
                                                               value="{{ request('keyword') }}"
                                                               class="input-sm form-control" placeholder="Search Here">
                                                        <span class="input-group-btn">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary custom_field_height"> Go!</button>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 p-0 responsive_p_l_15">
                                                <span>
                                                    <a href="{{ route('admin.users.index') }}"
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
                                    <th>Image</th>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">Email</th>
                                    <th class="text-left">Phone</th>
                                    <th class="text-left">Address</th>
                                    <th class="text-left">Referral Code</th>
                                    @canany(['user edit', 'user delete'])
                                        <th>Action</th>
                                    @endcanany

                                </tr>
                                </thead>
                                @foreach($users as $user)
                                    <tbody>
                                    <tr>
                                        <td>
                                            <img width="100" height="50"
                                                 src="{{ isset($user) ? @$user->image->url : '' }}" alt="Image">
                                        </td>
                                        <td class="text-left">{{ ucfirst(Str::limit(@$user->name, 50)) }}</td>
                                        <td class="text-left">{{ @$user->email }}</td>
                                        <td class="text-left">{{ @$user->phone }}</td>
                                        <td class="text-left">{{ @$user->address }}</td>
                                        <td class="text-left">{{ @$user->referral_code }}</td>
                                        @canany(['user edit', 'user delete'])
                                            <td>
                                                @canany(['user edit'])
                                                    <a href="{{ route('admin.users.edit', @$user->id) }}" title="Edit"
                                                       class="btn btn-info btn-sm cus_btn">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                @endcanany
                                                @canany(['user delete'])
                                                    <button onclick="deleteRow({{ @$user->id }})"
                                                            href="JavaScript:void(0)"
                                                            title="Delete" class="btn btn-danger btn-sm cus_btn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <form id="row-delete-form{{ @$user->id }}" method="POST"
                                                          class="d-none"
                                                          action="{{ route('admin.users.destroy', @$user->id) }}">
                                                        @method('DELETE')
                                                        @csrf()
                                                    </form>
                                                @endcanany
                                            </td>
                                        @endcanany
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            @if(!$users->count() > 0)
                                <div class="text-center">No User found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

