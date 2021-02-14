@push('style')
    <link href="{{ asset('backend/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endpush

<div class="col-md-12">
    <div class="form-group">
        <label for="title" class="control-label">Title<span class="required-star"> *</span></label>
        <input id="title" type="text" value="{{ isset($whatWeDo) ? @$whatWeDo->title : old('title')}}"
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
        <label for="sub_title" class="control-label">Sub-Title<span class="required-star"> *</span></label>
        <input id="sub_title" type="text" value="{{ isset($whatWeDo) ? @$whatWeDo->sub_title : old('sub_title')}}"
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
        <label for="youtube_link_1" class="control-label">Youtube Link 1<span class="required-star"> *</span> (You need to fill-up embed link)</label>
        <input id="youtube_link_1" type="text" value="{{ isset($whatWeDo) ? @$whatWeDo->youtube_link_1 : old('youtube_link_1')}}"
               placeholder="https://www.youtube.com/embed/D0a0aNqTehM"
               name="youtube_link_1" class="form-control" autofocus>
        @error('youtube_link_1')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="youtube_link_2" class="control-label">Youtube Link 2<span class="required-star"> *</span> (You need to fill-up embed link)</label>
        <input id="youtube_link_2" type="text" value="{{ isset($whatWeDo) ? @$whatWeDo->youtube_link_2 : old('youtube_link_2')}}"
               placeholder="https://www.youtube.com/embed/aqz-KE-bpKQ"
               name="youtube_link_2" class="form-control" autofocus>
        @error('youtube_link_2')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="description" class="control-label">Description<span class="required-star"> *</span></label>
        <textarea id="description"
                  name="description" class="form-control descriptionTextEditor"
        >{!! isset($whatWeDo) ? @$whatWeDo->description : old('description') !!}</textarea>

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


