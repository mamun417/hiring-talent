
@push('style')
    <link href="{{ asset('backend/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endpush

<div class="col-md-12">
    <div class="form-group">
        <label for="description_1" class="control-label">Description 1</label>
        <textarea id="description_1"
                  name="description_1" class="form-control description1TextEditor"> {!! isset($mission_and_value) ? @$mission_and_value->description_1 : old('description_1') !!}</textarea>

        @error('description_1')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="description_2" class="control-label">Description 2</label>
        <textarea id="description_2"
                  name="description_2" class="form-control description2TextEditor"> {!! isset($mission_and_value) ? @$mission_and_value->description_2 : old('description_2') !!}</textarea>

        @error('description_2')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>


<div class="col-md-12">
    <div class="form-group">
        <label for="background_img">Background Image</label>
        <div class="input-group">
            <div class="custom-file">
                <input accept="image/*" type="file" name="background_img" class="custom-file-input" id="background_img">
                <label class="custom-file-label" for="image_2">Choose file</label>
            </div>
        </div>
        @error('background_img')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

@push('script')
    <script src="{{ asset('backend/js/plugins/summernote/summernote-bs4.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.description1TextEditor').summernote();
            $('.description2TextEditor').summernote();
        });
    </script>
@endpush
