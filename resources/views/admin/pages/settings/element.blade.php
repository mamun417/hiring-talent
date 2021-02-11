<div class="col-md-12">
    <div class="form-group">
        <label id="site_name" class="control-label">Site Name</label>
        <input id="site_name" type="text"
               value="{{isset($setting->site_name) ? @$setting->site_name : old('site_name')}}"
               name="site_name" class="form-control">
        @error('site_name')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
         </span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="logo">Logo</label>
        <div class="input-group">
            <div class="custom-file">
                <input accept="image/*" type="file" name="logo"
                       class="custom-file-input" id="logo">
                <label class="custom-file-label" for="logo">Choose file</label>
            </div>
        </div>

        @error('logo')
            <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
