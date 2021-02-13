@extends('layouts.app')
@section('title', 'New Talent')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>

    </style>
@endsection

@section('content')

    <div class="black-page kill-ovr">
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-10 offset-md-1">
                    <!-- Title -->
                    <div class="talent-form-title mt-2 mb-2 text-center">
                        <h2 class="text-white">{{ @$talent_description->title }}</h2>
                    </div>
                    <div class="talent-form-text my-0 text-justify">
                        {!! @$talent_description->description !!}
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-6 offset-md-3">
                    <form action="{{ route('talents.store') }}" method="post" enctype="multipart/form-data"
                          class="talent-form">
                        @csrf
                        <div class="form-row mb-4">
                            <div class="col">
                                <input
                                    type="text"
                                    class="form-control shadow"
                                    placeholder="Talent Name*"
                                    required
                                    name="talent_name"
                                    value="{{ isset($talent) && @$talent->talent_name ?  @$talent->talent_name : old('talent_name') }}"
                                />
                                @error('talent_name')
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
                                    placeholder="Parent's Name for Minors"
                                    required
                                    name="parent_name"
                                    value="{{ isset($talent) && @$talent->parent_name ?  @$talent->parent_name : old('parent_name') }}"
                                />
                                @error('parent_name')
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
                                    placeholder="Email*"
                                    required
                                    name="email"
                                    value="{{ isset($talent) && @$talent->email ?  @$talent->email : old('email') }}"
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
                                    placeholder="Phone*"
                                    required
                                    name="phone"
                                    value="{{ isset($talent) && @$talent->phone ?  @$talent->phone : old('phone') }}"
                                />
                                @error('phone')
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
                                    class="form-control shadow date_of_birth"
                                    placeholder="Date of Birth*"
                                    required
                                    name="date_of_birth"
                                    value="{{ isset($talent) && @$talent->date_of_birth ?  @$talent->date_of_birth : old('date_of_birth') }}"
                                />
                                @error('date_of_birth')
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
                                    placeholder="Gender*"
                                    required
                                    name="gender"
                                    value="{{ isset($talent) && @$talent->gender ?  @$talent->gender : old('gender') }}"
                                />
                                @error('gender')
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
                                    placeholder="Eye color*"
                                    required
                                    name="eye_color"
                                    value="{{ isset($talent) && @$talent->eye_color ?  @$talent->eye_color : old('eye_color') }}"
                                />
                                @error('eye_color')
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
                                    placeholder="Hair color*"
                                    required
                                    name="hair_color"
                                    value="{{ isset($talent) && @$talent->hair_color ?  @$talent->hair_color : old('hair_color') }}"
                                />
                                @error('hair_color')
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
                                    placeholder="Height*"
                                    required
                                    name="height"
                                    value="{{ isset($talent) && @$talent->height ?  @$talent->height : old('height') }}"
                                />
                                @error('height')
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
                                    placeholder="Weight*"
                                    required
                                    name="weight"
                                    value="{{ isset($talent) && @$talent->weight ?  @$talent->weight : old('weight') }}"
                                />
                                @error('weight')
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
                                    placeholder="Shirt Size*"
                                    required
                                    name="shirt_size"
                                    value="{{ isset($talent) && @$talent->shirt_size ?  @$talent->shirt_size : old('shirt_size') }}"
                                />
                                @error('shirt_size')
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
                                    placeholder="Pant size*"
                                    required
                                    name="pant_size"
                                    value="{{ isset($talent) && @$talent->pant_size ?  @$talent->pant_size : old('pant_size') }}"
                                />
                                @error('pant_size')
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
                                    placeholder="Shoe Size*"
                                    required
                                    name="shoe_size"
                                    value="{{ isset($talent) && @$talent->shoe_size ?  @$talent->shoe_size : old('shoe_size') }}"
                                />
                                @error('shoe_size')
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
                                    placeholder="Ethnicity #1*"
                                    required
                                    name="ethnicity_one"
                                    value="{{ isset($talent) && @$talent->ethnicity_one ?  @$talent->ethnicity_one : old('ethnicity_one') }}"
                                />
                                @error('ethnicity_one')
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
                                    placeholder="Ethnicity #2*"
                                    required
                                    name="ethnicity_two"
                                    value="{{ isset($talent) && @$talent->ethnicity_two ?  @$talent->ethnicity_two : old('ethnicity_two') }}"
                                />
                                @error('ethnicity_two')
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
                                    placeholder="Mail Address"
                                    required
                                    name="mail_address"
                                    value="{{ isset($talent) && @$talent->mail_address ?  @$talent->mail_address : old('mail_address') }}"
                                />
                                @error('mail_address')
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
                                    value="{{ isset($talent) && @$talent->subject ?  @$talent->subject : old('subject') }}"
                                />
                                @error('subject')
                                <span class="help-block m-b-none text-danger">
                                        {{ $message }}
                                     </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                            <textarea
                                rows="4"
                                type="text"
                                class="form-control shadow"
                                placeholder="Your Message"
                                name="message"
                            >{{ isset($talent) && @$talent->message ?  @$talent->message : old('message') }}</textarea>
                                @error('message')
                                <span class="help-block m-b-none text-danger">
                                        {{ $message }}
                                     </span>
                                @enderror
                            </div>
                        </div>

                        <!--Start => image section-->
                        <div class="form-row mb-4">
                            <div class="col">
                                <span>
                                    Talent Photo #1 (Before uploading save file as first and last name 1. limit: 5mb)
                                </span>
                                <input
                                    type="file"
                                    class="form-control-file shadow p-2"
                                    onchange="talentImagePreview(event, 'imgInp1')"
                                    name="talent_image_one"
                                />
                                @error('talent_image_one')
                                <span class="help-block m-b-none text-danger">
                                        {{ $message }}
                                     </span>
                                @enderror
                                <div class="row">
                                    <div class="col-3">
                                        <img class="mt-3 img-thumbnail{{ isset($talent) ? '' : ' display_hidden' }}" id="imgInp1"
                                             src="{{ isset($talent) && @$talent->images()->where('type', 'one')->first()->url ? @$talent->images()->where('type', 'one')->first()->url : '' }}"
                                             alt="Your Image"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <span>Talent Photo #2 (Before uploading save file as first and
                                last name 2. limit: 5mb)</span>
                                <input
                                    type="file"
                                    onchange="talentImagePreview(event, 'image2')"
                                    class="form-control-file shadow p-2"
                                    name="talent_image_two"
                                />
                                @error('talent_image_two')
                                <span class="help-block m-b-none text-danger">
                                        {{ $message }}
                                     </span>
                                @enderror
                                <div class="row">
                                    <div class="col-3">
                                        <img class="mt-3 img-thumbnail{{ isset($talent) ? '' : ' display_hidden' }}" id="image2"
                                             src="{{ isset($talent) && @$talent->images()->where('type', 'two')->first()->url ? @$talent->images()->where('type', 'two')->first()->url : '' }}"
                                             alt="Your Image"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <span>Talent Photo #3 (Before uploading save file as first and
                                last name 3. limit: 5mb)</span>
                                <input
                                    type="file"
                                    onchange="talentImagePreview(event, 'image3')"
                                    class="form-control-file shadow p-2"
                                    name="talent_image_three"
                                />
                                @error('talent_image_three')
                                <span class="help-block m-b-none text-danger">
                                        {{ $message }}
                                     </span>
                                @enderror
                                <div class="row">
                                    <div class="col-3">
                                        <img class="mt-3 img-thumbnail{{ isset($talent) ? '' : ' display_hidden' }}" id="image3"
                                             src="{{ isset($talent) && @$talent->images()->where('type', 'three')->first()->url ? @$talent->images()->where('type', 'three')->first()->url : '' }}"
                                             alt="Your Image"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <span>Talent Photo #4 (Before uploading save file as first and
                                last name 4. limit: 5mb)</span>
                                <input
                                    type="file"
                                    onchange="talentImagePreview(event, 'image4')"
                                    class="form-control-file shadow p-2"
                                    name="talent_image_four"
                                />
                                @error('talent_image_four')
                                <span class="help-block m-b-none text-danger">
                                        {{ $message }}
                                     </span>
                                @enderror
                                <div class="row">
                                    <div class="col-3">
                                        <img class="mt-3 img-thumbnail{{ isset($talent) ? '' : ' display_hidden' }}" id="image4"
                                             src="{{ isset($talent) && @$talent->images()->where('type', 'four')->first()->url ? @$talent->images()->where('type', 'four')->first()->url : '' }}"
                                             alt="Your Image"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <span>Resume. Limit 5mb (Only support Pdf File)</span>
                                <input
                                    type="file"
                                    class="form-control-file shadow p-2"
                                    name="talent_resume"
                                />
                                @error('talent_resume')
                                <span class="help-block m-b-none text-danger">
                                        {{ $message }}
                                     </span>
                                @enderror
                            </div>
                        </div>
                        <!--End => image section-->


                        <div class="form-row mb-4">
                            <div class="col">
                                <input
                                    type="text"
                                    class="form-control shadow"
                                    placeholder="LA Casting Profile Link"
                                    name="la_casting_profile_link"
                                    value="{{ isset($talent) && @$talent->la_casting_profile_link ?  @$talent->la_casting_profile_link : old('la_casting_profile_link') }}"
                                />
                                @error('la_casting_profile_link')
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
                                    placeholder="Actor Access Profile Link"
                                    name="actor_access_profile_link"
                                    value="{{ isset($talent) && @$talent->actor_access_profile_link ?  @$talent->actor_access_profile_link : old('actor_access_profile_link') }}"
                                />
                                @error('actor_access_profile_link')
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
                                    placeholder="Website"
                                    name="website"
                                    value="{{ isset($talent) && @$talent->website ?  @$talent->website : old('website') }}"
                                />
                                @error('website')
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
                                    placeholder="IMDB Page"
                                    name="imdb_page"
                                    value="{{ isset($talent) && @$talent->imdb_page ?  @$talent->imdb_page : old('imdb_page') }}"
                                />
                                @error('imdb_page')
                                <span class="help-block m-b-none text-danger">
                                        {{ $message }}
                                     </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <textarea
                                    name="represent_agency"
                                    class="form-control shadow talent-form-last-field"
                                    placeholder="If represented by another Agency or Manager, state Agency name, division represented and contact info*"
                                >{{ isset($talent) && @$talent->represent_agency ?  @$talent->represent_agency : old('represent_agency') }}</textarea>
                                @error('represent_agency')
                                <span class="help-block m-b-none text-danger">
                                        {{ $message }}
                                     </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <p>
                                    *If error message received after clicking Submit, try
                                    reducing photo size or number of photos uploaded.
                                </p>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col-md-6">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-lg btn-block text-white rounded-pill">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="like-btn my-3 pt-4">
                        <table>
                            <tr>
                                <td class="pr-4">
                                    <a
                                        href="#"
                                        class="btn btn-primary btn-sm rounded-pill px-4 text-white"
                                    >
                                        <img width="15" height="15"
                                             src="{{ asset('frontend/img/like.svg') }}" alt=""/>
                                        Like 1
                                    </a>
                                </td>
                                <td>
                                    <a
                                        href="#"
                                        class="btn btn-primary btn-sm rounded-pill px-4 text-white"
                                    >
                                        <img
                                            width="15"
                                            height="15"
                                            src="{{ asset('frontend/img/twitter.svg') }}"
                                            alt=""
                                        />
                                        Twitter
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var talentImagePreview = function (event, id) {
            var output = document.getElementById(id);
            $(output).removeClass("display_hidden");
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(".date_of_birth").flatpickr({
            dateFormat: "d/m/Y",
            maxDate: "today",
        });
    </script>
@endsection
