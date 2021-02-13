@extends('layouts.app')
@section('title', 'My Profile')
@push('style')
    <style>
        .card {
            border-top: 2px solid #0D8EF2;
        }

        .form-control:focus {
            border-color: #0D8EF2 !important;
            box-shadow: 0 0 0 0.2rem rgba(92, 184, 92, 0.25) !important;
        }

        .talent-table tr td, .talent-table tr th {
            padding: 20px;
            border-top: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row mb-3 mt-5">
            <div class="col-md-3">
                @include('pages.profile.includes.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-body px-5">
                        <h5 class="h5 m-0">Talent Information
                            <small class="ml-4">
                                <a href="{{ route('talents.create') }}" class="text-info edit_info">Edit</a>
                            </small>
                        </h5>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm talent-table">
                                        <tr class="">
                                            <th>Talent Name:</th>
                                            <td>{{ @$talent->talent_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Parent Name:</th>
                                            <td>{{ @$talent->parent_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>{{ @$talent->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone:</th>
                                            <td>{{ @$talent->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date Of Birth:</th>
                                            <td>{{ @$talent->date_of_birth }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender:</th>
                                            <td>{{ @$talent->gender }}</td>
                                        </tr>
                                        <tr>
                                            <th>Eye Color:</th>
                                            <td>{{ @$talent->eye_color }}</td>
                                        </tr>
                                        <tr>
                                            <th>Hair Color:</th>
                                            <td>{{ @$talent->hair_color }}</td>
                                        </tr>
                                        <tr>
                                            <th>Height:</th>
                                            <td>{{ @$talent->height }}</td>
                                        </tr>
                                        <tr>
                                            <th>Weight:</th>
                                            <td>{{ @$talent->weight }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shirt Size:</th>
                                            <td>{{ @$talent->shirt_size }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pant Size:</th>
                                            <td>{{ @$talent->pant_size }}</td>
                                        </tr>
                                        <tr>
                                            <th>Image One</th>
                                            <td>

                                                <img height="100"
                                                     src="{{ isset($talent->images) ? $talent->images()->where('type', 'one')->first()->url : '' }}"
                                                     alt="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Image Three</th>
                                            <td>
                                                <img height="100"
                                                     src="{{ isset($talent->images) ? $talent->images()->where('type', 'three')->first()->url : '' }}"
                                                     alt="">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm talent-table">
                                        <tr>
                                            <th>Shoe Size:</th>
                                            <td>{{ @$talent->shoe_size }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ethnicity One:</th>
                                            <td>{{ @$talent->ethnicity_one }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ethnicity Two:</th>
                                            <td>{{ @$talent->ethnicity_two }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mail Address:</th>
                                            <td>{{ @$talent->mail_address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Subject:</th>
                                            <td>{{ @$talent->subject }}</td>
                                        </tr>
                                        <tr>
                                            <th>Referred By:</th>
                                            <td>{{ @$talent->refererBy->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Message:</th>
                                            <td>{{ @$talent->message }}</td>
                                        </tr>
                                        <tr>
                                            <th>La Casting Profile:</th>
                                            <td>{{ @$talent->la_casting_profile_link }}</td
                                        </tr>
                                        <tr>
                                            <th>Actor Access Profile:</th>
                                            <td>{{ @$talent->actor_access_profile_link }}</td>
                                        </tr>
                                        <tr>
                                            <th>Website:</th>
                                            <td>{{ @$talent->website }}</td>
                                        </tr>
                                        <tr>
                                            <th>IMDB Page:</th>
                                            <td>{{ @$talent->imdb_page }}</td>
                                        </tr>
                                        <tr>
                                            <th>Represent Agency:</th>
                                            <td>{{ @$talent->represent_agency }}</td>
                                        </tr>
                                        <tr>
                                            <th>Image Two</th>
                                            <td>
                                                <img height="100"
                                                     src="{{ isset($talent->images) ? $talent->images()->where('type', 'two')->first()->url : '' }}"
                                                     alt="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Image Four</th>
                                            <td>
                                                <img height="100"
                                                     src="{{ isset($talent->images) ? $talent->images()->where('type', 'four')->first()->url : '' }}"
                                                     alt="">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <p class="text-center">
                            @php
                                $resume_url = isset($talent->images) ? $talent->images()->where('type', 'resume')->first()->url : ''
                            @endphp
                            @if($resume_url)
                                <a target="_blank" href="{{ $resume_url }}">View Your Resume</a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>

        // File Upload image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });


    </script>
@endpush
