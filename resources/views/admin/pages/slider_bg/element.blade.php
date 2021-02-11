<div class="col-md-12">
    <div class="form-group">
        <label for="image">Image<span class="required-star"> *</span></label>
        <div class="input-group">
            <div class="custom-file">
                <input accept="image/*" type="file" name="image" class="custom-file-input" id="image">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
        </div>
        @error('image')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
    <img class="mb-3" src="{{ isset($slider) ? $slider->image->url : '' }}" width="100" alt="">
</div>
