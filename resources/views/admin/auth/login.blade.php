@extends('admin.auth.layouts.app')
@section('title', 'Login')

@section('content')
    <div class="col-sm-8 col-md-offset-4">
        <div class="ibox-content shadow">
            <a target="_blank" href="{{ url('/') }}">
                <div style="text-align: center">
                    <img alt="image" src="{{ @$globalSettingInfo->image->url }}" width="166" />
                </div>
            </a>

            <h3 class="font-bold">Login</h3>
            <form class="m-t" role="form" method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email"  required autocomplete="email" autofocus
                           placeholder="Email">
                    @error('email')
                    <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" name="password" required
                           autocomplete="current-password" placeholder="Password">
                    @error('password')
                    <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b"><strong>Login</strong></button>

                <a href="{{ route('admin.password.request') }}"><small>Forgot password?</small></a>

            </form>
        </div>
    </div>
@endsection
