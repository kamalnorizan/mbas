<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DPMA</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/falcon/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/falcon/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/falcon/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/falcon/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('/falcon/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('/falcon/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('/falcon/assets/js/config.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/simplebar/simplebar.min.js') }}"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('/falcon/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/falcon/assets/css/theme-rtl.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('/falcon/assets/css/theme.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('/falcon/assets/css/user-rtl.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('/falcon/assets/css/user.css') }}" rel="stylesheet" id="user-style-default">
    <link href="{{ asset('/css/dpma.css') }}" rel="stylesheet">
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>

            @include('falcon.menu')

            <div class="content">
                <!-- utk admin or client-admin -->
                @include('falcon.top')
                @yield('content')

                <div class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            @if(Session::has('msg'))
                                <div id="banner" class='alert alert-success x-msg' style="position:fixed; bottom:40px; right:160px; min-height:50px; width:40%; z-index:1000;">
                                    <strong>Alert</strong> <br>
                                    {{ session('msg') }}
                                </div>
                            @endif

                            @if(Session::has('error'))
                                <div class="alert alert-danger x-msg" style="position:fixed;bottom:40px; right: 60px; min-height:50px;width:40%;z-index:100;">
                                <strong>Alert</strong> <br>
                                {{ Session::get('error')}}
                                </div>
                            @endif

                            @yield('main')
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">Thank you for visiting DPMA<span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> {{ date('Y') }} &copy;
                                <a href="https://www.cybersecurity.my/">CyberSecurity Malaysia</a> &nbsp;&nbsp; | &nbsp;
                                <img src="/images/cybersecurity.png">
                            </p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v1.0.0</p>
                        </div>
                    </div>
                </footer>
            </div>

            {{-- @include('falcon.login') --}}
        </div>
    </main>

    @include('falcon.offcanvas')

    <script src="{{ asset('/falcon/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('/falcon/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('/falcon/assets/js/theme.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/jquery/jquery.min.js') }}"></script>
    @yield('js')
    <script>
        window.setTimeout(function () {
            $(".x-msg").hide('slow');
        }, 4000);
    </script>
</body>
</html>
