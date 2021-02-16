@extends('admin.layouts.app')

@section('title', 'Message Replies')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Message Replies</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>All Replies</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive m-t-md">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-left">User Name</th>
                                    <th class="text-left">Talent Name</th>
                                    <th class="text-left">User Email</th>
                                    <th class="text-left">Phone</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td class="text-left">{{ ucfirst(Str::limit(@$talent->parent_name, 50)) }}</td>
                                    <td class="text-left">{{ ucfirst(Str::limit(@$talent->talent_name, 50)) }}</td>
                                    <td class="text-left">{{ @$talent->email }}</td>
                                    <td class="text-left">{{ @$talent->phone }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <h3>Replies</h3>
                        <div class="table-responsive m-t-md">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-left">Replied By</th>
                                    <th class="text-left">Subject</th>
                                    <th class="text-left">Replied Message</th>
                                    <th class="text-left">Time</th>
                                    @canany(['talent reply delete'])
                                        <th width="10%">Action</th>
                                    @endcanany
                                </tr>
                                </thead>

                                <tbody>
                                @foreach(@$replies as $reply)
                                    <tr>
                                        <td class="text-left">{{ ucfirst(Str::limit(@$reply->createdUser->name, 50)) }}</td>
                                        <td class="text-left">{{ ucfirst(@$reply->subject) }}</td>
                                        <td class="text-left">{{ @$reply->message_body}}</td>
                                        <td class="text-left">{{ @$reply->created_at->diffForHumans() }}</td>
                                        @canany(['talent reply delete'])
                                            <td>
                                                @can('talent reply delete')
                                                    <button onclick="deleteRow({{ @$reply->id }})"
                                                            href="JavaScript:void(0)"
                                                            title="Delete" class="btn btn-danger btn-sm cus_btn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <form id="row-delete-form{{ @$reply->id }}" method="POST"
                                                          class="d-none"
                                                          action="{{ route('admin.talent.replies.destroy', @$reply->id) }}">
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

                            @if (count(@$replies))
                                {{ @$replies->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}
                            @else
                                <div class="text-center">No Replies found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

