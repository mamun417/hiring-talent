<div class="col-md-12">
    <div class="form-group">
        <label for="name" class="control-label">Name</label>
        <input id="name" value="{{ isset($role) ? $role->name : old('name') }}" type="text" name="name"
               class="form-control" autofocus>
        @error('name')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-12">
    <div class="row">
        @foreach($permissions as $key => $permission)
            <div class="col-sm-2 mb-3">
                <div class="card h-100">
                    <ul class="list-group">
                        <li class="list-group-item">
                            {{ ucfirst(str_replace('_', ' ', $key)) }}
                        </li>
                        @foreach($permission as $pms)
                            <li class="list-group-item">
                                @php
                                    $check_permissions = isset($role->permissions) ? $role->permissions()->pluck('id')->toArray() : []
                                @endphp
                                <input name="permission_ids[]"
                                       {{ in_array($pms->id, $check_permissions) ? 'checked' : '' }}   value="{{ $pms->id }}"
                                       type="checkbox" class="i-checks">
                                {{ ucwords(str_replace($key, ' ', $pms->name)) }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
        @error('permission_ids')
        <span class="help-block m-b-none text-danger">
            {{ $message }}
        </span>
        <br>
        <br>
        @enderror
    </div>
</div>
