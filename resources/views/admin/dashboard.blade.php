@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')

    <div class="">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Total Users </span>
                            <h2 class="font-bold">{{ @$users->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-envelope-o fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Total messages </span>
                            <h2 class="font-bold">{{ @$messages->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 yellow-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-deaf fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Total Talents </span>
                            <h2 class="font-bold">{{ @$talents->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-image fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Total Sliders </span>
                            <h2 class="font-bold">{{ @$sliders->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive m-t-md">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-left">User Name</th>
                            <th class="text-left">User Email</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Address</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach(@$users as $user)
                            <tr>
                                <td class="text-left">{{ ucfirst(@$user->name) }}</td>
                                <td class="text-left">{{ @$user->email }}</td>
                                <td class="text-left">{{ @$user->phone }}</td>
                                <td class="text-left">{{ @$user->address }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if (count(@$users))
                        {{ @$users->links('admin.components.paginate') }}
                    @else
                        <div class="text-center">No users found</div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
