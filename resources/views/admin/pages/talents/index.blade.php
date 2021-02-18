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
                            @canany(['talent reply'])
                                <div class="d-flex mb-2">
                                    <button class="btn btn-sm btn-success mr-2 sendMailSelectedTalentBtn">Send mail to
                                        selected talents
                                    </button>
                                    <button class="btn btn-sm btn-info sendAllTalent">Send mail to all talents</button>
                                </div>
                            @endcanany
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    @canany(['talent reply'])
                                        <th class="text-left" width="75">
                                            <input type="checkbox" id="checkAll"> <label for="checkAll">All</label>
                                        </th>
                                    @endcanany
                                    <th class="text-left">Talent Name</th>
                                    <th class="text-left">Email</th>
                                    <th class="text-left">Phone</th>
                                    <th class="text-left">Gender</th>
                                    <th class="text-left">Date Of Birth</th>
                                    <th class="text-left">Subject</th>
                                    <th class="text-left">Referred By</th>
                                    <th>Replied Count</th>
                                    @canany(['talent show', 'talent delete', 'talent reply', 'talent reply show', 'talent reply delete'])
                                        <th width="20%">Action</th>
                                    @endcanany
                                </tr>
                                </thead>

                                <tbody>
                                @foreach(@$talents as $talent)
                                    <tr>
                                        @canany(['talent reply'])
                                            <td class="text-left">
                                                <input type="checkbox" value="{{ $talent->id }}" class="checkedMe">
                                            </td>
                                        @endcanany
                                        <td class="text-left">{{ ucfirst(Str::limit(@$talent->talent_name, 50)) }}</td>
                                        <td class="text-left">{{ @$talent->email }}</td>
                                        <td class="text-left">{{ @$talent->phone }}</td>
                                        <td class="text-left">{{ @$talent->gender }}</td>
                                        <td class="text-left">{{ @$talent->date_of_birth }}</td>
                                        <td class="text-left">{{ @$talent->subject }}</td>
                                        <td class="text-left">{{ @$talent->refererBy->name ?? 'N/A' }}</td>
                                        <td>
                                                <span
                                                    class="badge badge-primary">{{ @$talent->replies()->count() }}</span>
                                        </td>
                                        @canany(['talent show', 'talent delete', 'talent reply', 'talent reply show', 'talent reply delete'])
                                            <td>
                                                @can('talent reply')
                                                    <a onclick="sendTalentMessageModal(event, '{{ @$talent->email.' '. @$talent->id }}')"
                                                       href="javascript:void(0)" title="Reply"
                                                       class="btn btn-sm btn-primary mb-1 mb-lg-0"
                                                    >
                                                        <i class="fa fa-reply-all"></i>
                                                    </a>
                                                @endcan
                                                @canany(['talent reply show', 'talent reply delete'])
                                                    <a href="{{ route('admin.talent.message.replies', @$talent->id)  }}"
                                                       title="Show Reply Details"
                                                       class="btn btn-success btn-sm cus_btn  mb-1 mb-lg-0">
                                                        <i class="fa fa-comment"></i>
                                                    </a>
                                                @endcanany
                                                @can('talent show')
                                                    <a href="{{ route('admin.talents.show', @$talent->id) }}"
                                                       title="Show Talent Details"
                                                       class="btn btn-warning btn-sm cus_btn  mb-1 mb-lg-0">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('talent delete')
                                                    <button onclick="deleteRow({{ @$talent->id }})"
                                                            href="JavaScript:void(0)"
                                                            title="Delete The Talent"
                                                            class="btn btn-danger btn-sm cus_btn  mb-1 mb-lg-0">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <form id="row-delete-form{{ @$talent->id }}" method="POST"
                                                          class="d-none"
                                                          action="{{ route('admin.talents.destroy', @$talent->id) }}">
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


    @include('admin.pages.talents.talentMailModal')
@endsection

@push('script')
    <script>
        function sendTalentMessageModal(event, talentInfo) {
            event.preventDefault();
            var talentInfo = talentInfo.split(' ');
            var email = talentInfo[0];
            var talent_id = talentInfo[1];
            $("#talentEmail").val(email)
            $("#talentMessageId").val(talent_id)
            $("#talentSendMessageModal").modal('show')
        }


        $("#checkAll").change(function () {
            $("input:checkbox").prop('checked', this.checked);
        });

        $(".checkedMe").click(function () {
            if ($(this).is(":checked")) {
                var isAllChecked = true; // initialize all is checked true

                $(".checkedMe").each(function () {
                    if (!this.checked)
                        isAllChecked = false;
                });

                if (isAllChecked) {
                    $("#checkAll").prop("checked", true);
                }
            } else {
                $("#checkAll").prop("checked", false);
            }
        });


        $(".sendAllTalent").on('click', (e) => {
            e.preventDefault();
            $("#sendMailAllTalentModal").modal('show');
        })

        $(".sendMailSelectedTalentBtn").on('click', (e) => {
            e.preventDefault();

            let talents = [];
            $(".checkedMe").each(function () {
                if (this.checked) {
                    talents.push($(this).val())
                }

            });

            if (talents.length) {
                $("#selectedTalentField").val(talents)
                $("#sendMailAllSelectedTalentModal").modal('show');
            } else {
                toastr.warning('First select some talents.');
            }
        })


    </script>
@endpush
