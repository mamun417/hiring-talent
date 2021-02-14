<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="control-label">Name<span class="required-star">*</span></label>
        <input required id="name" type="text"
               value="{{ isset($user->name) ? @$user->name : old('name')}}"
               name="name" class="form-control">
        @error('name')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="email">Email<span class="required-star">*</span></label>
        <input required id="email" type="email"
               value="{{ isset($user->email) ? @$user->email : old('email')}}"
               name="email" class="form-control">

        @error('email')
         <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="phone">Phone<span class="required-star">*</span></label>
        <input required id="phone" type="text"
               value="{{ isset($user->phone) ? @$user->phone : old('phone')}}"
               name="phone" class="form-control">

        @error('phone')
         <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="phone">Address<span class="required-star">*</span></label>
        <input required id="address" type="text"
               value="{{ isset($user->address) ? @$user->address : old('address')}}"
               name="address" class="form-control">

        @error('address')
         <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>


<div class="col-md-12">
    <div class="form-group">
        <label for="image">Image</label>
        <div class="input-group">
            <div class="custom-file">
                <input accept="image/*" type="file" name="image"
                       class="custom-file-input" id="image">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
        </div>

        @error('image')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
    @if(isset($user))
        <img src="{{ @$user->image->url }}" class="thumbnail" width="100px" height="80px">
        <br>
        <br>
    @endif
</div>

