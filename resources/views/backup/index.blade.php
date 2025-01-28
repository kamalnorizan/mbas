@extends('falcon.master')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.min.css">
@endsection

@section('content')
    <div class="card shadow-none border mb-2">
        <div class="bg-holder bg-card d-none d-md-block" style="background-image:url( {{ asset('falcon/assets/img/illustrations/reports-bg.png') }});">
        </div>

        <div class="card-header z-1">
            <div class="row flex-between-center gx-0">
                <div class="col-lg-auto d-flex align-items-center"><img class="img-fluid"
                        src="{{ asset('falcon/assets/img/illustrations/reports-greeting.png') }}" alt="" />
                    <div class="ms-x1">
                        <h4 class="mb-0 text-primary fw-bold">MBAS <span class="text-info fw-medium">Database Backups</span>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-auto d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="dropdown ms-2">
                            <button class="btn btn-outline-primary btn-sm " type="button" id="execBackup">
                                <i class="fas fa-plus"></i> Execute Backup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="card">
        <div class="card-body  z-1">
            <div class="table-responsive">
                <table class="table table-hover display responsive" id="backup-table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>File Name</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script>
        $(document).ready(function() {
            $('#backup-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('backup.ajaxLoadBackupLog') }}',
                    type: 'post',
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                    }
                },
                columns: [{
                        data: null,
                        name: 'row_number',
                        render: function(data, type, row, meta) {
                            return meta.row + 1 + meta.settings._iDisplayStart;
                        },
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'path',
                        name: 'path'
                    },
                    {
                        data: 'statusbc',
                        name: 'status'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'time'
                    },
                    {
                        data: 'ation',
                        searchable: false,
                        orderable: false
                    },
                ]
            });
        });

        $('#execBackup').click(function() {

            $(this).attr('disabled', true);
            $(this).html('<i class="fas fa-spinner fa-spin"></i> Executing Backup');

            $.ajax({
                url: "{{ route('backup.backuprun') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#backup-table').DataTable().ajax.reload();
                    $('#execBackup').attr('disabled', false);
                    $('#execBackup').html('<i class="fas fa-plus"></i> Execute Backup');
                },
                error: function(err) {
                    console.log(err);
                    $('#execBackup').attr('disabled', false);
                    $('#execBackup').html('<i class="fas fa-plus"></i> Execute Backup');
                }
            });
        });
    </script>
@endsection
