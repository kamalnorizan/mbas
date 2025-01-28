<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>MBAS | Web App Template</title>


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


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('falcon/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('falcon/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('falcon/assets/css/theme-rtl.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('falcon/assets/css/theme.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('falcon/assets/css/user-rtl.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('falcon/assets/css/user.css') }}" rel="stylesheet" id="user-style-default">
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

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-standard navbar-expand-lg fixed-top navbar-dark"
            data-navbar-darken-on-scroll="data-navbar-darken-on-scroll">
            <div class="container"><a class="navbar-brand" href="../index.html"><span
                        class="text-white dark__text-white">MBAS</span></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
                    <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
                        <li>
                            <a class="nav-link" href="{{ route('front.index') }}">Home</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li>
                                <a class="nav-link" id="" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endguest
                        @auth
                            <li>
                                <a class="nav-link" id="" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li>
                                <button type="button" class="nav-link logoutBtn" id="logout">Logout</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="row text-start justify-content-between align-items-center mb-2">
                            <div class="col-auto">
                                <h5 id="modalLabel">Register</h5>
                            </div>
                            <div class="col-auto">
                                <p class="fs--1 text-600 mb-0">Have an account? <a
                                        href="../pages/authentication/simple/login.html">Login</a></p>
                            </div>
                        </div>
                        <form>
                            <div class="mb-3">
                                <input class="form-control" type="text" autocomplete="on" placeholder="Name" />
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="email" autocomplete="on"
                                    placeholder="Email address" />
                            </div>
                            <div class="row gx-2">
                                <div class="mb-3 col-sm-6">
                                    <input class="form-control" type="password" autocomplete="on"
                                        placeholder="Password" />
                                </div>
                                <div class="mb-3 col-sm-6">
                                    <input class="form-control" type="password" autocomplete="on"
                                        placeholder="Confirm Password" />
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="modal-register-checkbox" />
                                <label class="form-label" for="modal-register-checkbox">I accept the <a
                                        href="#!">terms </a>and <a href="#!">privacy policy</a></label>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                    name="submit">Register</button>
                            </div>
                        </form>
                        <div class="position-relative mt-4">
                            <hr />
                            <div class="divider-content-center">or register with</div>
                        </div>
                        <div class="row g-2 mt-2">
                            <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100"
                                    href="#"><span class="fab fa-google-plus-g me-2"
                                        data-fa-transform="grow-8"></span> google</a></div>
                            <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100"
                                    href="#"><span class="fab fa-facebook-square me-2"
                                        data-fa-transform="grow-8"></span> facebook</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0 overflow-hidden" id="banner" data-bs-theme="light">

            <div class="bg-holder overlay"
                style="background-image:url({{ asset('falcon/assets/img/generic/bg-1.jpg') }});background-position: center bottom;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row flex-center pt-8 pt-lg-10 pb-lg-9 pb-xl-0">
                    <div class="col-md-11 col-lg-8 col-xl-4 pb-7 pb-xl-9 text-center text-xl-start">
                        <h1 class="text-white fw-light">Bring <span class="typed-text fw-bold"
                                data-typed-text='["design","beauty","elegance","perfection"]'></span><br />to your
                            webapp</h1>
                        <p class="lead text-white opacity-75">With the power of Falcon, you can now focus only on
                            functionaries for your digital products, while leaving the UI design on us!</p><a
                            class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-0 py-2"
                            href="#!">Start building with the MBAS Template<span class="fas fa-play ms-2"
                                data-fa-transform="shrink-6 down-1"></span></a>
                    </div>
                    <div class="col-xl-7 offset-xl-1 align-self-end mt-4 mt-xl-0"><a
                            class="img-landing-banner rounded" href="../index.html"><img class="img-fluid"
                                src="{{ asset('falcon/assets/img/generic/dashboard-alt.jpg') }}"
                                alt="" /></a></div>
                </div>
            </div>
            <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->




        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-3 bg-light shadow-sm">

            <div class="container">
                <div class="row flex-center">
                    <div class="col-3 col-sm-auto my-1 my-sm-3 px-x1"><img class="landing-cta-img" height="40"
                            src="{{ asset('falcon/assets/img/logos/b&w/6.png') }}" alt="" /></div>
                    <div class="col-3 col-sm-auto my-1 my-sm-3 px-x1"><img class="landing-cta-img" height="45"
                            src="{{ asset('falcon/assets/img/logos/b&w/11.png') }}" alt="" /></div>
                    <div class="col-3 col-sm-auto my-1 my-sm-3 px-x1"><img class="landing-cta-img" height="30"
                            src="{{ asset('falcon/assets/img/logos/b&w/2.png') }}" alt="" /></div>
                    <div class="col-3 col-sm-auto my-1 my-sm-3 px-x1"><img class="landing-cta-img" height="30"
                            src="{{ asset('falcon/assets/img/logos/b&w/4.png') }}" alt="" /></div>
                    <div class="col-3 col-sm-auto my-1 my-sm-3 px-x1"><img class="landing-cta-img" height="35"
                            src="{{ asset('falcon/assets/img/logos/b&w/1.png') }}" alt="" /></div>
                    <div class="col-3 col-sm-auto my-1 my-sm-3 px-x1"><img class="landing-cta-img" height="40"
                            src="{{ asset('falcon/assets/img/logos/b&w/10.png') }}" alt="" /></div>
                    <div class="col-3 col-sm-auto my-1 my-sm-3 px-x1"><img class="landing-cta-img" height="40"
                            src="{{ asset('falcon/assets/img/logos/b&w/12.png') }}" alt="" /></div>
                </div>
            </div>
            <!-- end of .container-->

        </section>

        <section class="bg-200 pt-4">
            <div class="container">
                <div class="mb-3 card">
                    <div class="bg-body-tertiary card-header">
                        <div class="justify-content-between row">
                            <div class="col">
                                <div class="d-flex">
                                    <a class="d-flex" href="#">
                                        <div class="avatar avatar-2xl status-online"><img class="rounded-circle "
                                                src="{{ asset('storage/profile/personal/' . $post->user->profile_picture) }}"
                                                alt=""></div>
                                    </a>
                                    <div class="flex-1 align-self-center ms-2">
                                        <p class="mb-1 lh-1"><a class="fw-semibold"
                                                href="#">{{ $post->user->name }}</a><span
                                                class="ms-1">created a post
                                                <strong>{{ $post->title }}</strong></span></p>
                                        <p class="mb-0 fs-10">{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{!! $post->content !!}</p>
                        <div>

                        </div>
                    </div>
                    <div class="bg-body-tertiary pt-0 card-footer">
                        <div class="border-bottom border-200 fs-10 py-3">
                            <a class="text-700 me-1" href="#">{{ $post->like_count }} likes</a>
                        </div>
                        <div class="g-0 fw-semibold text-center py-2 fs-10 row">
                            <div class="col-auto">
                                <div class="d-flex align-items-center rounded text-700 me-3 cursor-pointer"><img
                                        src="data:image/png;base64,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"
                                        alt="" width="20"><span class="ms-1">Like</span></div>
                            </div>
                        </div>
                        <form class="">
                            <div class="d-flex align-items-center border-top border-200 pt-3">
                                <div class="avatar avatar-xl "><img class="rounded-circle "
                                        src="{{ Auth::check() ? asset('storage/profile/personal/' . Auth::user()->profile_picture) : asset('storage/profile/personal/avatar.png') }}"
                                        alt=""></div>

                                <input
                                    placeholder="@guest Please login to write a comment @else Write a comment... @endguest "
                                    type="text" @guest disabled @endguest data-post="{{ $post->uuid }}"
                                    class="rounded-pill ms-2 fs-10 form-control commentInput" value="">
                            </div>
                        </form>
                        @foreach ($post->comments as $comment)
                            <div class="d-flex mt-3">
                                <a href="#">
                                    <div class="avatar avatar-xl "><img class="rounded-circle "
                                            src="{{ asset('storage/profile/personal/' . $comment->user->profile_picture) }}"
                                            alt="">
                                    </div>
                                </a>
                                <div class="flex-1 ms-2 fs-10">
                                    <p class="mb-1 bg-200 rounded-3 p-2"><a class="fw-semibold"
                                            href="{{ asset('storage/profile/personal/' . $comment->user->profile_picture) }}">{{ $comment->user->name }}</a>
                                    </p>
                                    <span class="ms-1">{{ $comment->content }}</span>
                                    <div class="px-2"><a href="#!">Like</a> • <a href="#!">Reply</a> •
                                        {{ $comment->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>





        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="bg-dark pt-8 pb-4" data-bs-theme="light">

            <div class="container">
                <div class="position-absolute btn-back-to-top bg-dark"><a class="text-600" href="#banner"
                        data-bs-offset-top="0"><span class="fas fa-chevron-up"
                            data-fa-transform="rotate-45"></span></a></div>
                <div class="row">
                    <div class="col-lg-4">
                        <h5 class="text-uppercase text-white opacity-85 mb-3">Our Mission</h5>
                        <p class="text-600">Falcon enables front end developers to build custom streamlined user
                            interfaces in a matter of hours, while it gives backend developers all the UI elements they
                            need to develop their web app.And it's rich design can be easily integrated with backends
                            whether your app is based on ruby on rails, laravel, express or any other server side
                            system.</p>
                        <div class="icon-group mt-4"><a class="icon-item bg-white text-facebook" href="#!"><span
                                    class="fab fa-facebook-f"></span></a><a class="icon-item bg-white text-twitter"
                                href="#!"><span class="fab fa-twitter"></span></a><a
                                class="icon-item bg-white text-google-plus" href="#!"><span
                                    class="fab fa-google-plus-g"></span></a><a
                                class="icon-item bg-white text-linkedin" href="#!"><span
                                    class="fab fa-linkedin-in"></span></a><a class="icon-item bg-white"
                                href="#!"><span class="fab fa-medium-m"></span></a></div>
                    </div>
                    <div class="col ps-lg-6 ps-xl-8">
                        <div class="row mt-5 mt-lg-0">
                            <div class="col-6 col-md-3">
                                <h5 class="text-uppercase text-white opacity-85 mb-3">Company</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-1"><a class="link-600" href="#!">About</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Contact</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Careers</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Blog</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Terms</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Privacy</a></li>
                                    <li><a class="link-600" href="#!">Imprint</a></li>
                                </ul>
                            </div>
                            <div class="col-6 col-md-3">
                                <h5 class="text-uppercase text-white opacity-85 mb-3">Product</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-1"><a class="link-600" href="#!">Features</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Roadmap</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Changelog</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Pricing</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Docs</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">System Status</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Agencies</a></li>
                                    <li class="mb-1"><a class="link-600" href="#!">Enterprise</a></li>
                                </ul>
                            </div>
                            <div class="col mt-5 mt-md-0">
                                <h5 class="text-uppercase text-white opacity-85 mb-3">From the Blog</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <h5 class="fs-0 mb-0"><a class="link-600" href="#!"> Interactive graphs
                                                and charts</a></h5>
                                        <p class="text-600 opacity-50">Jan 15 &bull; 8min read </p>
                                    </li>
                                    <li>
                                        <h5 class="fs-0 mb-0"><a class="link-600" href="#!"> Lifetime free
                                                updates</a></h5>
                                        <p class="text-600 opacity-50">Jan 5 &bull; 3min read &starf;</p>
                                    </li>
                                    <li>
                                        <h5 class="fs-0 mb-0"><a class="link-600" href="#!"> Merry Christmas
                                                From us</a></h5>
                                        <p class="text-600 opacity-50">Dec 25 &bull; 2min read</p>
                                    </li>
                                    <li>
                                        <h5 class="fs-0 mb-0"><a class="link-600" href="#!"> The New Falcon
                                                Theme</a></h5>
                                        <p class="text-600 opacity-50">Dec 23 &bull; 10min read </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->




        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0 bg-dark" data-bs-theme="light">

            <div>
                <hr class="my-0 text-600 opacity-25" />
                <div class="container py-3">
                    <div class="row justify-content-between fs--1">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600 opacity-85">Thank you for creating with Falcon <span
                                    class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2023 &copy;
                                <a class="text-white opacity-85" href="https://themewagon.com">Themewagon</a>
                            </p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600 opacity-85">v3.17.0</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of .container-->

        </section>

    </main>

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('falcon/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/swiper/swiper-bundle.min.js') }}">
        ') }}
    </script>
    <script src="{{ asset('falcon/vendors/typed.js/typed.js') }}"></script>
    <script src="{{ asset('falcon/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('falcon/vendors/lodash/lodash.min.js') }}"></script>
    {{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script> --}}
    <script src="{{ asset('falcon/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('falcon/assets/js/theme.js') }}"></script>

    <script>
        $('.logoutBtn').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('logout') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    window.location.href = "{{ route('front.index') }}";
                }
            });
        });

        $('.commentInput').on('keypress', function(e) {
            var comment = $(this).val();
            var post = $(this).data('post');
            if (e.which === 13) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{ route('comments.store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        content: comment,
                        post_uuid: post
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
