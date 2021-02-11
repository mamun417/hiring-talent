
@push('style')
    <link href="{{ asset('backend/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endpush

<div class="col-md-12">
    <div class="form-group">
        <label for="title" class="control-label">Title</label>
        <input id="title"
                  name="title" value="{{ isset($talent_description) ? @$talent_description->title : old('title')}}" type="text" class="form-control">

        @error('title')
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
                  name="description" class="form-control descriptionTextEditor"> {!! isset($talent_description) ? @$talent_description->description : old('description') !!}</textarea>

        @error('description')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
@push('script')
    <script src="{{ asset('backend/js/plugins/summernote/summernote-bs4.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.descriptionTextEditor').summernote();
        });
    </script>
@endpush
