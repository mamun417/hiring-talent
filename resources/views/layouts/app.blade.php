<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>@yield('title', config('app.name')) | {{ config('app.name', 'Laravel') }}</title>

    <!-- All CSS -->
    @include('includes.all-css')
    @yield('style')

    <style>
        #fullPageLoader {
            background: url('{{ asset('frontend/img/page-loader.gif') }}') no-repeat scroll center center #fff;
            position: fixed;
            height: 100%;
            width: 100%;
            z-index: 9999;
            opacity: 0.5;
            top: 0;
        }
    </style>

    <!-- style -->
    @stack('style')

<!--Optional JavaScript-->
    <!--jQuery first, then Popper.js, then Bootstrap JS-->
    <script src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
</head>

<body>
<div id="fullPageLoader" class="d-none"></div>

<!-- Preloader -->
<div class="preloader d-flex align-items-center justify-content-center">
    <div class="cssload-container">
        <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
    </div>
</div>

<!--  Header Area Start -->
@include('includes.header')
<!-- Header Area End -->

@yield('content')

<!-- Login Modal -->
@include('auth.login')

<!-- Forgot Password Modal -->
@include('auth.passwords.email')

<!-- Signup Modal -->
@include('auth.register')

@include('includes.contact-modal')

<!--  Footer Area Start -->
@include('includes.footer')
<!-- Footer Area End -->

<!-- all js -->
@include('includes.all-js')
@yield('script')

<script>
    function showLoading() {
        $('#fullPageLoader').removeClass('d-none');
    }

    function hideLoading() {
        $('#fullPageLoader').addClass('d-none');
    }
</script>

<!-- script -->
@stack('script')

</body>

</html>
