<div class="col-md-6">
    <div class="form-group">
        <label for="name" class="control-label">Name</label>
        <input id="name" type="text" name="name"
               value="{{ isset($permission) ? $permission->name : old('name') }}"
               class="form-control" autofocus>
        @error('name')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="module_name" class="control-label">Module Name</label>
        <input id="module_name" type="text" name="module_name"
               value="{{ isset($permission) ? $permission->module_name : old('module_name') }}"
               class="form-control" autofocus>
        @error('module_name')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
