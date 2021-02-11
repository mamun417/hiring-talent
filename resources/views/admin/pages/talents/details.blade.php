@extends('admin.layouts.app')
@section('title', 'Talent Details')

@push('style')

@endpush

@section('content')
    <div class="row wrapper border-bottom white-bg py-3">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.talents.index') }}">Talent</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Details</strong>
                </li>
            </ol>
            <a class="btn btn-sm btn-primary pull-right m-t-n-md boardCreateModalShow"
               href="{{ route('admin.talents.index') }}"><i
                    class="fa fa-list"></i> <strong>ALL TALENT</strong></a>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title text-center">
                        <h1>Talent Details</h1>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Talent Name
                                            :</strong> {{ @$talent->talent_name }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Parent Name
                                            :</strong> {{ @$talent->parent_name }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Email
                                            :</strong> {{ @$talent->email }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Phone
                                            :</strong> {{ @$talent->phone }}</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Date Of Birth
                                            :</strong> {{ @$talent->date_of_birth }}</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Gender
                                            :</strong> {{ @$talent->gender }}</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Eye Color
                                            :</strong> {{ @$talent->eye_color }}</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Hair Color
                                            :</strong> {{ @$talent->hair_color }}</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Height
                                            :</strong> {{ @$talent->height }}</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Weight
                                            :</strong> {{ @$talent->weight }}</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Shirt Size
                                            :</strong> {{ @@$talent->shirt_size }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Pant Size
                                            :</strong> {{ @$talent->pant_size }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Shoe Size
                                            :</strong> {{ @$talent->shoe_size }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Ethnicity One
                                            :</strong> {{ @$talent->ethnicity_one }}</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Ethnicity Two
                                            :</strong> {{ @$talent->ethnicity_two }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Mail Address
                                            :</strong> {{ @$talent->mail_address }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Subject
                                            :</strong> {{ @$talent->subject }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Referred By
                                            :</strong> {{ @$talent->refererBy->name ?? 'N/A' }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Message
                                            :</strong> {{ @$talent->message }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>La Casting Profile Link
                                            :</strong> {{ @$talent->la_casting_profile_link }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Actor Access Profile Link
                                            :</strong> {{ @$talent->actor_access_profile_link }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Website
                                            :</strong> {{ @$talent->website }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Imdb Page
                                            :</strong> {{ @$talent->imdb_page }}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>Represent Agency
                                            :</strong> {{ @$talent->represent_agency }}</label>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Start => file upload section -->
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Talent <strong>File </strong> Upload</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach(@$talent->images as $image)
                                        <div class="col-2" id="removeProductImageSection">
                                            @if($image->type == 'resume')
                                                <a target="_blank" href="{{ $image->url }}">Resume Click to
                                                    dowenload</a>
                                            @else
                                                <div class="input-group">
                                                    <img class="d-block" width="100%"
                                                         src="{{ @$image->url }}"
                                                         alt="{{ @$image->type }}">
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

