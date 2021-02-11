@push('style')
    <link href="{{ asset('backend/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endpush

<div class="col-md-12">
    <div class="form-group">
        <label for="title" class="control-label">Title</label>
        <input id="title" type="text" value="{{ isset($portfolio) ? @$portfolio->title : old('title')}}"
               name="title" class="form-control" autofocus>
        @error('title')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="sub_title" class="control-label">Sub Title</label>
        <input id="sub_title" type="text" value="{{ isset($portfolio) ? @$portfolio->sub_title : old('sub_title')}}"
               name="sub_title" class="form-control" autofocus>
        @error('sub_title')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="description" class="control-label">Description</label>
        <textarea id="description"
                  name="description"
                  class="form-control descriptionTextEditor"> {!! isset($portfolio) ? @$portfolio->description : old('description') !!}</textarea>

        @error('description')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="image_1">Image 1</label>
        <div class="input-group">
            <div class="custom-file">
                <input accept="image/*" type="file" name="image_1" class="custom-file-input" id="image_1">
                <label class="custom-file-label" for="image_1">Choose file</label>
            </div>
        </div>
        @error('image1')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="image_2">Image 2</label>
        <div class="input-group">
            <div class="custom-file">
                <input accept="image/*" type="file" name="image_2" class="custom-file-input" id="image_2">
                <label class="custom-file-label" for="image_2">Choose file</label>
            </div>
        </div>
        @error('image_2')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="image_3">Image 3</label>
        <div class="input-group">
            <div class="custom-file">
                <input accept="image/*" type="file" name="image_3" class="custom-file-input" id="image_3">
                <label class="custom-file-label" for="image_3">Choose file</label>
            </div>
        </div>
        @error('image_3')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="image_4">Image 4</label>
        <div class="input-group">
            <div class="custom-file">
                <input accept="image/*" type="file" name="image_4" class="custom-file-input" id="image_4">
                <label class="custom-file-label" for="image_3">Choose file</label>
            </div>
        </div>
        @error('image_4')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

@push('script')
    <script src="{{ asset('backend/js/plugins/summernote/summernote-bs4.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.descriptionTextEditor').summernote();
        });
    </script>
@endpush
