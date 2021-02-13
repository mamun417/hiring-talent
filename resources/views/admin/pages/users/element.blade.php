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

@if(!isset($user))
    <div class="col-md-6">
        <div class="form-group">
            <label for="password" class="control-label">Password<span class="required-star">*</span></label>
            <input required id="password" type="password"
                   name="password" class="form-control">

            @error('password')
                <span class="help-block m-b-none text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="confirm_password" class="control-label">Confirm Password<span class="required-star">*</span></label>
            <input required id="confirm_password" type="password"
                   name="confirm_password" class="form-control">

            @error('confirm_password')
            <span class="help-block m-b-none text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
@else
    <div class="col-md-12">
        <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <input id="password" type="password"
                   name="password" class="form-control">

            @error('password')
            <span class="help-block m-b-none text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
@endif

@php
    $check_user_roles = isset($user) ? $user->roles()->pluck('id')->toArray() : [];
@endphp

<div class="col-md-12">
    <div class="form-group">
        <label for="type" class="control-label">Role<span class="required-star">*</span></label><br>
        @foreach($roles as $role)
            <span class="ml-sm-3">{{ ucfirst($role->name) }}</span> <input value="{{ $role->id }}" {{ isset($user) && in_array($role->id, $check_user_roles) ? "checked" : ''}} type="checkbox" name="type[]"  class="i-checks">
        @endforeach

        @error('type')
            <span class="help-block m-b-none text-danger">
                {{ $message }}
            </span>
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

