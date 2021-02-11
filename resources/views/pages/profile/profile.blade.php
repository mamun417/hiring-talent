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
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row mb-3 mt-5">
        <div class="col-md-3">
            @include('pages.profile.includes.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card shadow mb-3">
                <div class="card-body px-5">
                    <h5 class="h5 m-0">Personal Information <small class="ml-4"><a href="javascript:void(0)"
                                class="text-info edit_info">Edit</a></small></h5>
                    <hr class="my-4">
                    <form id="info" action="{{ route('user.update.profile') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" placeholder="Name" class="form-control" name="name"
                                        value="{{ isset($user) ? @$user->name : old('name')}}">
                                    @error('name')
                                    <small class="text-danger">{{ @$message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="phone">Mobile Number</label>
                                    <input type="text" placeholder="Mobile Number" class="form-control" name="phone"
                                        value="{{ isset($user) ? @$user->phone : old('phone')}}">
                                    @error('phone')
                                    <small class="text-danger">{{ @$message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" placeholder="Email Address" class="form-control" name="email"
                                        value="{{ isset($user) ? @$user->email : old('email')}}">
                                    @error('email')
                                    <small class="text-danger">{{ @$message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address"
                                        class="form-control">{{ isset($user) ? @$user->address : old('address')}}</textarea>
                                    @error('address')
                                    <small class="text-danger">{{ @$message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="image">Profile Picture</label>
                                    <input type="file" class="form-control-file" id="imgInp" name="image">
                                    @error('image')
                                    <small class="text-danger">{{ @$message }}</small>
                                    @enderror
                                    <img class="mt-3 img-thumbnail {{ isset($user->image) ? '' : 'display_hidden' }}"
                                        id="image"
                                        src="{{ isset(auth()->user()->image) && auth()->user()->image ? auth()->user()->image->url : '' }}"
                                        alt="Your Image" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button id="updateInfoBtnForUser" type="submit"
                                    class="btn btn-success py-1 px-4">Update</button>
                            </div>
                        </div>
                    </form>
                    <div class="py-4">
                        <hr>
                    </div>
                    <h5 class="h5 m-0">Password <small class="ml-4"><a href="javascript:void(0)"
                                class="text-info edit_pass">Edit</a></small></h5>
                    <hr class="my-4">
                    <form action="{{ route('user.update.profile.password') }}" method="post" id="pass">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="old_password">Your Current Password</label>
                                    <input type="password" placeholder="Your Current Password" class="form-control"
                                        name="old_password" value="{{ old('old_password') }}" required>
                                    @error('old_password')
                                    <small class="text-danger">{{ @$message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" placeholder="New Password" class="form-control"
                                        name="new_password" value="{{ old('new_password') }}" required>
                                    @error('new_password')
                                    <small class="text-danger">{{ @$message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" placeholder="Confirm Password" class="form-control"
                                        name="confirm_password" value="{{ old('confirm_password') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <button type="submit" id="passUpdateInfoBtnForUser"
                                    class="btn btn-success py-1 px-4">Save</button>
                            </div>
                        </div>
                    </form>
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
                reader.onload = function(e) {
                    $('#image').removeClass('display_hidden')
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
        });


        $(document).ready(function(){

            // user info update script sections
            $('#info input').prop("disabled", true);
            $('#info textarea').prop("disabled", true);
            $('#updateInfoBtnForUser').hide();
            $(".edit_info").click(function(){
                $('#info input').prop("disabled", false);
                $('#info textarea').prop("disabled", false);
                $('#updateInfoBtnForUser').show();
            });

            // user password update script sections
            $('#pass input').prop("disabled", true);
            $('#passUpdateInfoBtnForUser').hide();
            $(".edit_pass").click(function(){
                $('#pass input').prop("disabled", false);
                $('#passUpdateInfoBtnForUser').show();
            });

        });

</script>
@endpush
