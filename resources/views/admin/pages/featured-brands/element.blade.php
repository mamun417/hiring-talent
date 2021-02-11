<div class="col-md-12">
    <div class="form-group">
        <label for="name" class="control-label">Name<span class="required-star"> *</span></label>
        <input id="name" type="text" value="{{ isset($featuredBrand) ? @$featuredBrand->name : old('name')}}"
               name="name" class="form-control" autofocus>
        @error('name')
        <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="title" class="control-label">Title<span class="required-star"> *</span></label>
        <input id="title" type="text" value="{{ isset($featuredBrand) ? @$featuredBrand->title : old('title')}}"
               name="title" class="form-control" autofocus>
        @error('title')
        <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="featured_brands_image">Image<span class="required-star"> *</span></label>
        <div class="input-group">
            <div class="custom-file">
                <input accept="image/*" type="file" name="featured_brands_image" class="custom-file-input" id="featured_brands_image">
                <label class="custom-file-label" for="featured_brands_image">Choose file</label>
            </div>
        </div>
        @error('featured_brands_image')
        <span class="help-block m-b-none text-danger">{{ @$message }}</span>
        @enderror
    </div>
</div>
