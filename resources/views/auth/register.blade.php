<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>MBAS Template</title>
    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('falcon/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('falcon/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('falcon/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('falcon/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('falcon/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('falcon/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('falcon/assets/js/config.js') }}"></script>
    <script src="{{ asset('falcon/vendors/simplebar/simplebar.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('vendors/simplebar/simplebar.min.css" rel') }}="stylesheet">
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
    <style>
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #dc3545;
        }
    </style>
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
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
            <div class="row flex-center min-vh-90 py-6">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <a class="d-flex flex-center mb-4" href="#">
                        <img class="me-2" src="{{ asset('/falcon/assets/img/icons/spot-illustrations/falcon.png') }}"
                            alt="" width="58" />
                        <span class="font-sans-serif fw-bolder fs-5 d-inline-block">MBAS Template</span>
                    </a>
                    <div class="card theme-wizard">
                        <div class="card-header  pt-3 pb-2">
                            <div class="row flex-between-center mb-2">
                                <div class="col-auto">
                                    <h5>Register</h5>
                                </div>
                                <div class="col-auto fs--1 text-600"><span class="mb-0 undefined">or</span>
                                    <span>Have an account? <a href="{{ route('login') }}">Login</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-header bg-body-tertiary pt-3 pb-2">
                            <ul class="nav justify-content-between nav-wizard" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active fw-semi-bold" href="#" data-bs-toggle="tab"
                                        data-bs-target="#bootstrap-wizard-validation-tab1" data-wizard-step="1"
                                        aria-selected="true" role="tab"><span class="nav-item-circle-parent">
                                            <span class="nav-item-circle">
                                                <span class="fas fa-user"></span>
                                            </span>
                                        </span>
                                        <span class="d-none d-md-block mt-1 fs-10">Account</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link disabled fw-semi-bold " href="#" data-bs-toggle="tab"
                                        data-bs-target="#bootstrap-wizard-validation-tab2" data-wizard-step="2"
                                        aria-selected="false" tabindex="-1" role="tab">
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle">
                                                <span class="fas fa-envelope"></span>
                                            </span>
                                        </span>
                                        <span class="d-none d-md-block mt-1 fs-10">Verify</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link fw-semi-bold " href="#" data-bs-toggle="tab"
                                        data-bs-target="#bootstrap-wizard-validation-tab3" data-wizard-step="3"
                                        aria-selected="false" tabindex="-1" role="tab">
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle">
                                                <span class="fas fa-mobile"></span>
                                            </span>
                                        </span>
                                        <span class="d-none d-md-block mt-1 fs-10">Phone</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link fw-semi-bold disabled" href="#" data-bs-toggle="tab"
                                        data-bs-target="#bootstrap-wizard-validation-tab4" data-wizard-step="4"
                                        aria-selected="false" tabindex="-1" role="tab">
                                        <span class="nav-item-circle-parent">
                                            <span class="nav-item-circle">
                                                <span class="fas fa-thumbs-up"></span>
                                            </span>
                                        </span>
                                        <span class="d-none d-md-block mt-1 fs-10">Done</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel"
                                    aria-labelledby="bootstrap-wizard-validation-tab1"
                                    id="bootstrap-wizard-validation-tab1">
                                    <form id="pg1" data-wizard-form="1">
                                        <div class="mb-3">
                                            <input class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" name="name" type="text"
                                                autocomplete="on" placeholder="Name" required />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ old('phone') }}" name="phone" type="text"
                                                autocomplete="on" placeholder="Mobile Phone (0123456789)" required />
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                type="email" name="email" value="{{ old('email') }}"
                                                autocomplete="on" placeholder="Email address"
                                                pattern="^([a-zA-Z0-9_\.\-])+@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$"
                                                data-wizard-validate-email="true" />
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="row gx-2 mb-3">
                                            <div class=" col-sm-6">
                                                <input class="form-control  @error('password') is-invalid @enderror"
                                                    type="password" autocomplete="on" name="password"
                                                    placeholder="Password" />

                                            </div>
                                            <div class=" col-sm-6">
                                                <input class="form-control  @error('password') is-invalid @enderror"
                                                    type="password" autocomplete="on" name="password_confirmation"
                                                    placeholder="Confirm Password" />
                                            </div>
                                            @error('password')
                                                {{-- <div class="col-sm-12"> --}}
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                {{-- </div> --}}
                                            @enderror
                                        </div>
                                        <div class="form-check">
                                            <input required class="form-check-input" type="checkbox" name="term"
                                                id="basic-register-checkbox" /><label class="form-label"
                                                for="basic-register-checkbox">I accept the <a href="#!">terms
                                                </a>and <a class="white-space-nowrap" href="#!">privacy
                                                    policy</a></label>
                                            @error('term')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}

                                        @error('g-recaptcha-response')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </form>
                                </div>
                                <div class="tab-pane " role="tabpanel"
                                    aria-labelledby="bootstrap-wizard-validation-tab2"
                                    id="bootstrap-wizard-validation-tab2">
                                    <p>
                                        We have sent a verification code to your email address. Please enter the code
                                        below.
                                    </p>
                                    <form id="pg2" data-wizard-form="2">
                                        <div class="mb-3">
                                            <input class="form-control" type="text" name="otp"
                                                placeholder="Code OTP (Email)" required />
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane " role="tabpanel"
                                    aria-labelledby="bootstrap-wizard-validation-tab3"
                                    id="bootstrap-wizard-validation-tab3">
                                    <p>
                                        We have sent a verification code to your mobile via sms. Please enter the code
                                        below.
                                    </p>
                                    <form id="pg3" data-wizard-form="3">
                                        <div class="mb-3">
                                            <input class="form-control" type="text" name="otpmobile"
                                                placeholder="Code OTP (Mobile)" required />
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane text-center px-sm-3 px-md-5" role="tabpanel"
                                    aria-labelledby="bootstrap-wizard-validation-tab4" id="bootstrap-wizard-validation-tab4">
                                    <div class="wizard-lottie-wrapper">
                                        <div class="lottie wizard-lottie mx-auto my-3"
                                            data-options='{"path":"{{ asset('falcon/assets/img/animated-icons/celebration.json') }}"}'>
                                        </div>
                                    </div>
                                    <h4 class="mb-1">Your account is all set!</h4>
                                    <p>Now you can access to your account</p><a class="btn btn-primary px-5 my-3"
                                        href="{{ route('login') }}">Login</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-body-tertiary">
                            <ul class="pager  list-inline mb-0">
                                <li class="previous">
                                    <button class="btn btn-link ps-0 d-none" id="btnPrev" type="button">
                                        <span class="fas fa-chevron-left me-2" data-fa-transform="shrink-3"></span>
                                        Prev
                                    </button>
                                </li>
                                <li class="next">
                                    <button class="btn btn-primary px-5 px-sm-6 float-end" id="btnNext"
                                        type="button">
                                        Next
                                        <span class="fas fa-chevron-right ms-2" data-fa-transform="shrink-3">
                                        </span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('/falcon/vendors/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('falcon/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/lottie/lottie.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('falcon/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('falcon/assets/js/theme.js') }}"></script>
    <script>
        $('#btnNext').click(function(e) {
            e.preventDefault();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            var $activeTab = $('.nav-link.active');
            var currTab = $activeTab.data('wizard-step');

            var data = $('#pg' + currTab).serialize();
            data += '&step=' + currTab;
            data += '&_token=' + '{{ csrf_token() }}';

            if (currTab == 2) {
                data += '&otpPhone=' + $('#pg1 input[name=phone]').val();
            }

            if (currTab == 3) {
                data += '&name=' + $('#pg1 input[name=name]').val();
                data += '&phone=' + $('#pg1 input[name=phone]').val();
                data += '&email=' + $('#pg1 input[name=email]').val();
                data += '&password=' + $('#pg1 input[name=password]').val();
            }

            $.ajax({
                type: "post",
                url: "{{ route('register.validate') }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        if (currTab == 1) {
                            $('#otpPhone').val($('#pg1 input[name=phone]').val());
                        }

                        $('.nav-link[data-wizard-step="' + (currTab) + '"]').addClass('disabled');
                        $('.nav-link[data-wizard-step="' + (currTab + 1) + '"]').tab('show');

                        if (currTab == 3) {
                            $('.pager').addClass('d-none');
                        }
                    } else {
                        if (currTab == 2) {
                            var input = $('#pg' + currTab + ' input[name=otp]');
                            input.addClass('is-invalid');
                            input.parent().append('<div class="invalid-feedback">' + response.message +
                                '</div>');
                        }
                    }
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        if (key == 'g-recaptcha-response') {
                            var recaptchaContainer = $('.g-recaptcha');
                            recaptchaContainer.addClass('is-invalid');
                            recaptchaContainer.parent().append(
                                '<div class="invalid-feedback d-block">' + value + '</div>');
                        } else {
                            var input = $('#pg' + currTab + ' input[name=' + key + ']');
                            input.addClass('is-invalid');
                            input.parent().append('<div class="invalid-feedback">' + value +
                                '</div>');

                            var select = $('#pg' + currTab + ' select[name=' + key + ']');
                            select.addClass('is-invalid');
                            select.parent().append('<div class="invalid-feedback">' + value +
                                '</div>');
                        }
                        if (currTab == 1) {
                            grecaptcha.reset();
                        }
                    });
                }
            });


            if ($('.form-control:invalid').length > 0) {
                return false;
            } else if (!recaptchaResponse) {
                recaptchaError.style.display = 'block';
                return;
            } else {
                $('#btnPrev').removeClass('d-none');
            }
            $('.nav-link[data-wizard-step="' + (currTab + 1) + '"]').tab('show');
        });

        $('#btnPrev').click(function(e) {
            var $activeTab = $('.nav-link.active');
            var currTab = $activeTab.data('wizard-step');
        });
    </script>

</body>

</html>
