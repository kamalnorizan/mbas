@extends('falcon.master')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.min.css">
    <style>
        .dt-info {
            margin-top: 15px;
        }

        .dt-search {
            float: right !important;
        }

        .role {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="card shadow-none border mb-2">
        <div class="bg-holder bg-card d-none d-md-block"
            style="background-image:url( {{ asset('falcon/assets/img/illustrations/reports-bg.png') }});">
        </div>
        <!--/.bg-holder-->

        <div class="card-header z-1">
            <div class="row flex-between-center gx-0">
                <div class="col-lg-auto d-flex align-items-center"><img class="img-fluid"
                        src="{{ asset('falcon/assets/img/illustrations/reports-greeting.png') }}" alt="" />
                    <div class="ms-x1">
                        <h4 class="mb-0 text-primary fw-bold">MBAS <span class="text-info fw-medium">User Management</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">

        <div class="card-header border-bottom">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0" data-anchor="data-anchor" id="responsive-table">User Management<a
                            class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#responsive-table"
                            style="margin-left: 0.1875em; padding-right: 0.1875em; padding-left: 0.1875em;"></a></h5>
                </div>
                <div class="col-auto ms-auto">
                    <a class="btn btn-primary" href="{{ route('posts.create') }}"><i class="fa fa-plus"
                            aria-hidden="true"></i> Create New Post</a>
                </div>
            </div>
        </div>
        <div class="card-body position-relative  bg-body-tertiary">
            <div class="row">
                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover display responsive" id="post-table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Heading</th>
                                        <th>Role</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="role-model" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Assign Role </h4>
                    </div>
                    <div class="p-4 pb-2 pt-2 ">
                        <input type="hidden" id="user_id" name="user_id">
                        <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                            <label for="role">Role</label>
                            <select id="role" name="role" class="form-control" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{ $errors->first('role') }}</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="assignRoleBtn" type="button">Assign Role </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>

    <script>
        var postTbl = $('#post-table').DataTable({
            "dom": '<"container-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('users.index') }}',
                type: 'GET'
            },
            columns: [{
                    data: 'profile_picture',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'heading',
                    name: 'heading'
                },
                {
                    data: 'roles',
                    searchable: false
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $(document).on("click", ".role", function(e) {
            e.preventDefault();
            var role = $(this).text();
            role = role.toLowerCase();
            var user_id = $(this).data('uuid');
            $('#user_id').val(user_id);
            $('#role').val(role);
            $('#role-model').modal('show');
        });

        $('#assignRoleBtn').click(function(e) {
            e.preventDefault();
            var user_id = $('#user_id').val();
            var role = $('#role').val();
            $.ajax({
                url: '{{ route('users.assignrole') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: user_id,
                    role: role
                },
                success: function(data) {
                    $('#role-model').modal('hide');
                    swal("Role assigned successfully", {
                        icon: 'success',
                        buttons: {
                            cancel: {
                                text: "OK",
                                value: null,
                                visible: true,
                                className: "",
                                closeModal: true,
                            }
                        }
                    });
                    postTbl.ajax.reload();
                }
            });
        });

        $(document).on("click", ".delete", function(e) {
            e.preventDefault();
            var user_id = $(this).data('uuid');
            var url = "{{ route('users.destroy', ['uuid' => ':id']) }}";
            url = url.replace(':id', user_id);
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this user!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE',
                                user_id: user_id
                            },
                            success: function(data) {
                                swal("User deleted successfully", {
                                    icon: 'success',
                                    buttons: {
                                        cancel: {
                                            text: "OK",
                                            value: null,
                                            visible: true,
                                            className: "",
                                            closeModal: true,
                                        }
                                    }
                                });
                                postTbl.ajax.reload();
                            }
                        });
                    }
                });
        });
    </script>
@endsection
