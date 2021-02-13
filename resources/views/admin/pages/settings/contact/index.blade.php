@extends('admin.layouts.app')

@section('title', 'Contacts')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Contacts</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Contacts</h5>
                        @can('contact create')
                            @if(\App\Models\Contact::count() < 1)
                                <a href="{{ route('admin.contacts.create') }}"
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
                                    <th class="text-left">Address</th>
                                    <th class="text-left">Phone Number 1</th>
                                    <th class="text-left">Phone Number 2</th>
                                    <th class="text-left">Telephone</th>
                                    <th class="text-left">Email</th>
                                    {{--<th class="text-left">Fax</th>--}}
                                    @can('contact edit')
                                        <th class="text-center" width="8%">Actions</th>
                                    @endcan
                                </tr>
                                </thead>

                                @if(isset($contact))
                                    <tbody>
                                    <tr>
                                        <td class="text-left">{{ ucfirst(Str::limit(@$contact->address, 50)) }}</td>
                                        <td class="text-left">{{ @$contact->phone_1 }}</td>
                                        <td class="text-left">{{ @$contact->phone_2 }}</td>
                                        <td class="text-left">{{ @$contact->telephone }}</td>
                                        <td class="text-left">{{ @$contact->email }}</td>
                                        {{--<td class="text-left">{{ @$contact->fax }}</td>--}}
                                        @can('contact edit')
                                            <td>
                                                <a href="{{ route('admin.contacts.edit', @$contact->id) }}" title="Edit"
                                                   class="btn btn-info btn-sm cus_btn">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>
                                    </tbody>
                                @endif
                            </table>
                            @if(!isset($contact))
                                <div class="text-center">No contact found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

