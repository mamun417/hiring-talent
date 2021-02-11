@extends('layouts.app')

@section('content')
    @if(!auth()->check())
        <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content signin-modal">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body signin-modal">
                        <form class="white-form" id="reset-password-form" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <input name="email" type="email" class="form-control shadow" id="email" placeholder="Your Email" value="{{ $email }}">
                                <small class="text-danger error_msg"></small>
                            </div>

                            <div class="form-group">
                                <input name="password" type="password" class="form-control shadow" id="password" placeholder="New Password">
                                <small class="text-danger error_msg"></small>
                            </div>

                            <div class="form-group">
                                <input name="password_confirmation" type="password" placeholder="Confirm New Password" class="form-control shadow">
                                <small class="text-danger error_msg"></small>
                            </div>

                            <button type="button"
                                    onclick="event.preventDefault(); $('#reset-password-form').submit()"
                                    class="btn btn-primary btn-block shadow rounded-pill">
                                Submit
                            </button>
                        </form>

                        <div class="text-center">
                            <span class="d-block mt-3">Returning Customer?</span>
                            <a href="javascript:void(0)" data-toggle="modal" data-dismiss="modal" data-target="#loginModal"
                               class="signup-link">
                                Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('auth.auth-script', ['form' => 'reset-password-form', 'modal_id' => 'resetPasswordModal']) {{-- form = id --}}
    @endif
@endsection

@push('script')
    <script>
        let checkAuth = "{{ auth()->check() }}"
        if (!checkAuth){
            $(function () {
                $('#resetPasswordModal').modal('show')
            })
        }else{
            location.replace('{{ route('home') }}')
        }
    </script>
@endpush

