@extends('admin.layouts.app')

@section('title', 'Talents')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Talents</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>All Talents</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{ route('admin.talents.index')}}" method="get"
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
                                                    <a href="{{ route('admin.talents.index') }}"
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
                                    <th class="text-left">Talent Name</th>
                                    <th class="text-left">Email</th>
                                    <th class="text-left">Phone</th>
                                    <th class="text-left">Gender</th>
                                    <th class="text-left">Date Of Birth</th>
                                    <th class="text-left">Subject</th>
                                    <th class="text-left">Referee By</th>
                                    @canany(['talent send message', 'talent show'])
                                        <th>Action</th>
                                    @endcanany
                                </tr>
                                </thead>

                                <tbody>
                                @foreach(@$talents as $talent)
                                    <tr>
                                        <td class="text-left">{{ ucfirst(Str::limit(@$talent->talent_name, 50)) }}</td>
                                        <td class="text-left">{{ @$talent->email }}</td>
                                        <td class="text-left">{{ @$talent->phone }}</td>
                                        <td class="text-left">{{ @$talent->gender }}</td>
                                        <td class="text-left">{{ @$talent->date_of_birth }}</td>
                                        <td class="text-left">{{ @$talent->subject }}</td>
                                        <td class="text-left">{{ @$talent->refererBy->name ?? 'N/A' }}</td>
                                        @canany(['talent send message', 'talent show'])
                                            <td>
                                                @can('talent send message')
                                                    <a onclick="sendTalentMessageModal(event, '{{ @$talent->email }}')"
                                                       href="javascript:void(0)" title="Send Message"
                                                       class="btn btn-info btn-sm cus_btn"
                                                    >
                                                       <i class="fa fa-reply-all"></i>
                                                    </a>
                                                @endcan
                                                @can('talent show')
                                                    <a href="{{ route('admin.talents.show', @$talent->id) }}"
                                                       title="Show"
                                                       class="btn btn-info btn-sm cus_btn">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if (count(@$talents))
                                {{ @$talents->appends(['keyword' => request('keyword'), 'perPage' => request('perPage')])->links() }}

                            @else
                                <div class="text-center">No Talents found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="talentSendMessageModal" tabindex="-1" role="dialog"
         aria-labelledby="talentSendMessageModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="talentSendMessageModal">Message Send</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.send.message.to-talent') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="talentEmail">Email</label>
                            <input type="email" class="form-control" name="talent_email" id="talentEmail">
                            @error('talent_email')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input class="form-control" id="subject" type="text" name="subject">
                            @error('subject')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="message_body">Message</label>
                            <textarea class="form-control" name="message_body" id="message_body" cols="30"
                                      rows="10"></textarea>
                            @error('message_body')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        function sendTalentMessageModal(event, email) {
            event.preventDefault();
            $("#talentEmail").val(email)
            $("#talentSendMessageModal").modal('show')
        }
    </script>
@endpush
