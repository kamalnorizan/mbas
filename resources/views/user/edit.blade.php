@extends('falcon.master')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-3 btn-reveal-trigger">
                <div class="card-header position-relative min-vh-25 mb-8">
                    <div class="cover-image">
                        <div class="bg-holder rounded-3 rounded-bottom-0"
                            style="background-image:url({{ asset('storage/profile/cover/' . $user->cover_image) }});">
                        </div>
                        <!--/.bg-holder-->

                        <form action="{{ route('users.updatecover') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="uuid" id="uuid" class="form-control" value="{{$user->uuid}}">

                            <input class="d-none" id="cover_image" name="cover_image" type="file" />
                        </form>
                        <label class="cover-image-file-input" for="cover_image"><span
                                class="fas fa-camera me-2"></span><span>Change cover photo</span></label>
                    </div>
                    <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
                        <div class="h-100 w-100 rounded-circle overflow-hidden position-relative"> <img
                                src="{{ asset('storage/profile/personal/' . $user->profile_picture) }}" width="200"
                                alt="" data-dz-thumbnail="data-dz-thumbnail" />
                            <form action="{{ route('users.updateimage') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="uuid" id="uuid" class="form-control" value="{{$user->uuid}}">
                                <input class="d-none" id="profile_image" name="profile_image" type="file" />
                            </form>
                            <label class="mb-0 overlay-icon d-flex flex-center" for="profile_image"><span
                                    class="bg-holder overlay overlay-0"></span><span
                                    class="z-1 text-white dark__text-white text-center fs--1"><span
                                        class="fas fa-camera"></span><span class="d-block">Update</span></span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-8 pe-lg-2">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Profile Settings</h5>
                </div>
                <div class="card-body bg-light">
                    <form class="row g-3" action="{{ route('users.update',['uuid'=>$user->uuid]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="uuid" id="uuid" class="form-control" value="{{$user->uuid}}">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                    class="form-control" required="required">
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control" required>
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone"
                                    value="{{ old('phone', $user->phone) }}" class="form-control" required="required">
                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('heading') ? 'has-error' : '' }}">
                                <label for="heading">Heading</label>
                                <input type="text" id="heading" name="heading"
                                    value="{{ old('heading', $user->heading) }}" class="form-control" required="required">
                                <small class="text-danger">{{ $errors->first('heading') }}</small>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('intro') ? 'has-error' : '' }}">
                                <label for="intro">Intro</label>
                                <textarea id="intro" cols="30" rows="7" name="intro" class="form-control">{{ old('intro', $user->intro) }} </textarea>
                                <small class="text-danger">{{ $errors->first('intro') }}</small>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Reset Password</h5>
                    </div>
                    <div class="card-body bg-light">
                        <form action="{{ route('users.resetPassword') }}" method="POST">
                            @csrf
                            <input type="hidden" name="uuid" id="uuid" class="form-control" value="{{$user->uuid}}">
                            <button class="btn btn-primary d-block w-100" type="submit">Reset Password </button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Danger Zone</h5>
                    </div>
                    <div class="card-body bg-light">
                        <h5 class="fs-0">Delete this account</h5>
                        <p class="fs--1">Once you delete a account, there is no going back. Please be certain.</p><button
                            class="btn btn-falcon-danger d-block" type="button" id="deactivateBtn">Deactivate Account</button>
                            <form id="deleteAcc"  action="{{route('users.destroy',['uuid'=>$user->uuid])}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        $('#profile_image').change(function(e) {
            e.preventDefault();
            $(this).parent().submit();
        });

        $('#cover_image').change(function(e) {
            e.preventDefault();
            $(this).parent().submit();
        });

        @if ($errors->has('profile_image'))
            alert('{{ $errors->first('profile_image') }}');
        @endif

        @if ($errors->has('cover_image'))
            alert('{{ $errors->first('cover_image') }}');
        @endif

        $('#deactivateBtn').click(function (e) {
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this account again!",
                icon: "warning",
                buttons: {cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn btn-secondary",
                    closeModal: true,
                },
                confirm: {
                    text: "Yes, i'm sure!",
                    value: true,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true
                }}
            }).then((value)=>{
                if(value){
                    $('#deleteAcc').submit();
                }
            });
        });
    </script>
@endsection
