<!-- Register Modal -->
<div
    class="modal fade"
    id="signUpModal"
    tabindex="-1"
    aria-labelledby="signUpModal"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content signin-modal">
            <div class="modal-header">
                <h5 class="modal-title">Sign Up</h5>
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
                                    href="#"
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
                            <a href="#" class="fb-btn btn btn-block shadow rounded-pill"
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
                            <hr class="hr-text" data-content="OR"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form class="white-form" id="register-form" action="{{ route('register') }}">
                                @csrf
                                <div class="form-row mb-4">
                                    <div class="col">
                                        <input
                                            type="text"
                                            name="name"
                                            class="form-control shadow"
                                            placeholder="Full Name*"
                                        />
                                        <small class="text-danger error_msg"></small>
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="col">
                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control shadow"
                                            placeholder="Email Address*"
                                        />
                                        <small class="text-danger error_msg"></small>
                                    </div>
                                </div>
                                <!-- <div class="form-row mb-4">
                                    <div class="col">
                                        <input
                                            type="text"
                                            class="form-control shadow"
                                            placeholder="Phone Number*"
                                        />
                                    </div>
                                </div>-->
                                <div class="form-row mb-4">
                                    <div class="col">
                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control shadow"
                                            placeholder="Password*"
                                        />
                                        <small class="text-danger error_msg"></small>
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="col">
                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            class="form-control shadow"
                                            placeholder="Confirm Password*"
                                        />
                                        <small class="text-danger error_msg"></small>
                                    </div>
                                </div>
                                <div class="form-row mb-4 ml-auto">
                                    <div class="col-6 ml-auto">
                                        <button
                                            type="button"
                                            onclick="event.preventDefault(); $('#register-form').submit()"
                                            class="btn btn-primary btn-block shadow rounded-pill"
                                        >
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
                                <p>
                                    Already have an account?
                                    <a class="text-info" href="#"
                                       data-toggle="modal" data-dismiss="modal" data-target="#loginModal"
                                    >Log In
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

@include('auth.auth-script', ['form' => 'register-form', 'modal_id' => 'signUpModal']) {{-- form = id --}}
