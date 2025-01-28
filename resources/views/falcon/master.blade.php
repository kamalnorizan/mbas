<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MBAS Template</title>
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
    <link href="{{ asset('/falcon/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/falcon/assets/css/theme-rtl.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('/falcon/assets/css/theme.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('/falcon/assets/css/user-rtl.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('/falcon/assets/css/user.css') }}" rel="stylesheet" id="user-style-default">
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

    @yield('style')
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
                @include('falcon.top')
                <div class="row">
                    <div class="col-md-12">
                        @include('flash::message')
                    </div>
                </div>
                @yield('content')

                <div class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            @yield('main')
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">Thank you for visiting MBAS Template<span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> {{ date('Y') }} &copy;
                                <a href="https://pbt.kedah.gov.my/">Majlis Bandaraya Alor Setar</a> &nbsp;&nbsp;
                            </p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v1.0.0</p>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </main>
    @yield('modals')
    @include('falcon.offcanvas')
    <script src="{{ asset('/falcon/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('/falcon/vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('/falcon/assets/js/flatpickr.js') }}"></script>
    {{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script> --}}
    <script src="{{ asset('/falcon/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('/falcon/assets/js/theme.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('js')
    <script>
        $('.logoutBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('logout') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    window.location.href = "{{ route('front.index') }}";
                }
            });
        });

        window.setTimeout(function () {
            $(".x-msg").hide('slow');
        }, 4000);
    </script>
</body>
</html>
