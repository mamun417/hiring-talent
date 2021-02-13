<!-- All Modal -->

<!-- Contact Modal -->
<div
    class="modal fade"
    id="contactModal"
    tabindex="-1"
    aria-labelledby="contactModal"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content black-page">
            <div class="modal-body">
                <div class="modal-close-btn">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container-fluid">
                    <div class="mt-4 mb-2 reg-modal talent-form">
                        <div class="row mb-3">
                            <div class="col">
                                <h2 class="text-center">Contact Us</h2>
                                <p class="text-center">Let’s Start Now!</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center my-4">
                                    <p>Let’s Start Now!</p>
                                    <p>
                                        <i
                                        >Whether you want to work as an actor or model or hire
                                            talent for your project, we want to hear from you!</i
                                        >
                                    </p>
                                    <p class="mb-0"><i>{{ @$globalContactInfo->phone_1 }}</i></p>
                                    <p class="mb-0"><i>{{ @$globalContactInfo->email }}</i></p>
                                    <a class="btn btn-primary text-white px-2 rounded-pill" href="{{ route('talents.create') }}">Add New Talent</a>
                                </div>
                            </div>
                            <div class="col-md-6 border-middle">
                                <!-- contact form -->
                                <form action="{{ route('messages.store') }}" method="post" class="contact_form mt-2">
                                    @csrf
                                    <div class="form-row mb-4 talent-form">
                                        <div class="col">
                                            <input
                                                type="text"
                                                class="form-control shadow"
                                                placeholder="Full Name*"
                                                required
                                                name="name"
                                                value="{{ old('name') }}"
                                            />
                                            @error('name')
                                            <span class="help-block m-b-none text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col">
                                            <input
                                                type="email"
                                                class="form-control shadow"
                                                placeholder="Email Address*"
                                                required
                                                name="email"
                                                value="{{ old('email') }}"
                                            />
                                            @error('email')
                                            <span class="help-block m-b-none text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col">
                                            <input
                                                type="text"
                                                class="form-control shadow"
                                                placeholder="Subject"
                                                required
                                                name="subject"
                                                value="{{ old('subject') }}"
                                            />
                                            @error('subject')
                                            <span class="help-block m-b-none text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col">
											<textarea
                                                name="message"
                                                rows="2"
                                                class="form-control shadow msg-box"
                                                placeholder="Message..."
                                            ></textarea>
                                            @error('message')
                                            <span class="help-block m-b-none text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col">
                                            <div class="text-center">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary text-white px-5 rounded-pill"
                                                >
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <p class="text-center">
                                By registering, you agree to the
                                <a href="javascript:void(0)" class="text-primary">Terms of Use</a> and
                                <a href="javascript:void(0)" class="text-primary">Privacy Policy</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
