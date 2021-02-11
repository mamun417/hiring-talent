<div
    class="modal fade"
    id="forgotPasswordModal"
    tabindex="-1"
    aria-labelledby="forgotPasswordModal"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content signin-modal">
            <div class="modal-body signin-modal">
                <div class="px-3">
                    <h5 class="my-4">Rest Password</h5>
                    <div class="row">
                        <div class="col">
                            <form class="white-form" id="forgot-password-form" action="{{ route('password.email') }}">
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
                                <div class="form-row mb-4 ml-auto">
                                    <div class="col-6 ml-auto">
                                        <button type="button"
                                                onclick="event.preventDefault(); $('#forgot-password-form').submit()"
                                                class="btn btn-primary btn-block shadow rounded-pill">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('auth.auth-script', ['form' => 'forgot-password-form', 'modal_id' => 'forgotPasswordModal']) {{-- form = id --}}

