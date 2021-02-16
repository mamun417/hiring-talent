<!-- Login Modal -->
<div
    class="modal fade"
    id="loginModal"
    tabindex="-1"
    aria-labelledby="loginModal"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content signin-modal">
            <div class="modal-header">
                <h5 class="modal-title">Sign In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="modal_close_btn_color" aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body signin-modal">
                <div class="px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-contact-modal">
                                <a
                                    href="{{ route('login.social', 'google') }}"
                                    class="border-d9 google-btn btn btn-default btn-block shadow rounded-pill"
                                ><img
                                        src="{{ asset('frontend/img/google.svg') }}"
                                        width="20"
                                        height="20"
                                        alt="Google"
                                    />
                                    Google
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a
                                href="{{ route('login.social', 'facebook') }}"
                                class="fb-btn btn btn-block shadow rounded-pill"
                            ><img
                                    src="{{ asset('frontend/img/facebook.svg') }}"
                                    width="20"
                                    height="20"
                                    alt="Facebook"
                                />
                                Facebook
                            </a>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <hr class="hr-text" data-content="OR">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <form class="white-form" id="login-form" action="{{ route('login') }}">
                                @csrf
                                <div class="form-row mb-4">
                                    <div class="col">
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            class="form-control shadow"
                                            placeholder="Email*"
                                        />
                                        <small class="text-danger error_msg"></small>
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="col">
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            class="form-control shadow"
                                            placeholder="Password*"
                                        />
                                        <small class="text-danger error_msg"></small>
                                    </div>
                                </div>
                                <div class="form-row mb-4 ml-auto">
                                    <div class="col-6 ml-auto float-left">
                                        <a class="text-info" href="#" data-toggle="modal" data-target="#forgotPasswordModal">
                                            Forgot Password
                                        </a>
                                    </div>
                                    <div class="col-6 ml-auto">
                                        <button type="button"
                                                onclick="event.preventDefault(); $('#login-form').submit()"
                                                class="btn btn-primary btn-block shadow rounded-pill">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <p>Don't have an account?
                                    <a class="text-info" href="#" data-toggle="modal" data-target="#signUpModal">
                                        Sign Up
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('auth.auth-script', ['form' => 'login-form', 'modal_id' => 'loginModal']) {{-- form = id --}}
