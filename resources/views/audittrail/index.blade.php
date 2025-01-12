@extends('falcon.master')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
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

        #post-table {
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
    <div class="card shadow-none border">
        <div class="bg-holder bg-card d-none d-md-block"
            style="background-image:url( {{ asset('falcon/assets/img/illustrations/reports-bg.png') }});">
        </div>
        <!--/.bg-holder-->

        <div class="card-header z-1">
            <div class="row flex-between-center gx-0">
                <div class="col-lg-auto d-flex align-items-center"><img class="img-fluid"
                        src="{{ asset('falcon/assets/img/illustrations/reports-greeting.png') }}" alt="" />
                    <div class="ms-x1">
                        <h4 class="mb-0 text-primary fw-bold">MBAS <span class="text-info fw-medium">Audit Trails</span>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-auto pt-3 pt-lg-0">
                    <form
                        class="row flex-lg-column flex-xxl-row gx-3 gy-2 align-items-center align-items-lg-start align-items-xxl-center">
                        <div class="col-auto">
                            <h6 class="text-700 mb-0">Showing Data For: </h6>
                        </div>
                        <div class="col-md-auto position-relative">
                            <input class="form-control form-control-sm ps-4" id="reportsDateRange" type="text"
                                data-options="{&quot;mode&quot;:&quot;range&quot;,&quot;dateFormat&quot;:&quot;M d&quot;,&quot;disableMobile&quot;:true , &quot;defaultDate&quot;: [&quot;{{ \Carbon\Carbon::parse()->subDays(7)->format('M d') }}&quot;, &quot;{{ \Carbon\Carbon::parse()->format('M d') }}&quot;] }" /><span
                                class="fas fa-calendar-alt text-primary position-absolute top-50 translate-middle-y ms-2">
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0" id="post-table">
                    <thead>
                        <tr>
                            <th>Date/Time</th>
                            <th>User</th>
                            <th>Module</th>
                            <th>Action</th>
                            <th>Old Values</th>
                            <th>New Values</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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

    <script>
        $("#reportsDateRange").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            mode: "range",
            defaultDate: ['{{ \Carbon\Carbon::parse()->subDays(7)->format('Y-m-d') }}',
                '{{ \Carbon\Carbon::parse()->format('Y-m-d') }}'
            ]
        });

        $("#reportsDateRange").change(function() {
            postTbl.ajax.reload();
        });

        var postTbl = $('#post-table').DataTable({
            "dom": '<"container-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('audittrail.ajaxLoadAuditTrail') }}',
                type: 'POST',
                data: function(d) {
                    d._token = '{{ csrf_token() }}';
                    d.datefilter = $('#reportsDateRange').val();
                }
            },
            columns: [{
                    data: 'datetime',
                    name: 'created_at',
                    sortable: false
                },
                {
                    data: 'user',
                    name: 'user.name',
                    sortable: false
                },
                {
                    data: 'module',
                    name: 'auditable_type',
                    sortable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    sortable: false
                },
                {
                    data: 'old_values',
                    name: 'old_values',
                    sortable: false
                },
                {
                    data: 'new_values',
                    name: 'new_values',
                    sortable: false
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
