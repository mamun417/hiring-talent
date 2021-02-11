<div class="col-md-12">
    <div class="form-group">
        <label id="address" class="control-label">Address</label>
        <input id="address" type="text"
               value="{{ isset($contact->address) ? @$contact->address : old('address')}}"
               name="address" class="form-control">
        @error('address')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="phone_1">Phone Number 1</label>
        <input id="phone_1" type="text"
               value="{{ isset($contact->phone_1) ? @$contact->phone_1 : old('phone_1')}}"
               name="phone_1" class="form-control">

        @error('phone_1')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="phone_2">Phone Number 2</label>
        <input id="phone_2" type="text"
               value="{{ isset($contact->phone_2) ? @$contact->phone_2 : old('phone_2')}}"
               name="phone_2" class="form-control">

        @error('phone_2')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="telephone">Telephone</label>
        <input id="telephone" type="text"
               value="{{ isset($contact->telephone) ? @$contact->telephone : old('telephone')}}"
               name="telephone" class="form-control">

        @error('telephone')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email"
               value="{{ isset($contact->email) ? @$contact->email : old('email')}}"
               name="email" class="form-control">

        @error('email')
        <span class="help-block m-b-none text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

{{--<div class="col-md-12">--}}
{{--    <div class="form-group">--}}
{{--        <label for="fax">Fax</label>--}}
{{--        <input id="fax" type="text"--}}
{{--               value="{{ isset($contact->fax) ? @$contact->fax : old('fax')}}"--}}
{{--               name="fax" class="form-control">--}}

{{--        @error('fax')--}}
{{--        <span class="help-block m-b-none text-danger">{{ $message }}</span>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--</div>--}}
