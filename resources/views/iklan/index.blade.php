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

        #iklan-table {
            font-size: 14px;
        }
    </style>
@endsection

@section('content')
    <div class="card shadow-none border mb-2">
        <div class="bg-holder bg-card d-none d-md-block"
            style="background-image:url( {{ asset('falcon/assets/img/illustrations/reports-bg.png') }});">
        </div>

        <div class="card-header z-1">
            <div class="row flex-between-center gx-0">
                <div class="col-lg-auto d-flex align-items-center"><img class="img-fluid"
                        src="{{ asset('falcon/assets/img/illustrations/reports-greeting.png') }}" alt="" />
                    <div class="ms-x1">
                        <h4 class="mb-0 text-primary fw-bold">MBAS <span class="text-info fw-medium">Iklan</span>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-auto d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="dropdown ms-2">
                            <button class="btn btn-outline-primary btn-sm " type="button" id="tmbhBtn">
                                <i class="fas fa-plus"></i> Add Iklan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0  display responsive" id="iklan-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdl-iklan" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Iklan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formIklan" method="post">
                        @csrf
                        <input type="hidden" name="uuid" id="uuid" class="form-control" value="">

                        <div class="mb-3">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}"
                                    class="form-control" required="required">
                                <small class="text-danger">{{ $errors->first('title') }}</small>
                            </div>
                        </div>
                        <div class="mb-3 min-vh-30">
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">Content</label>
                                <textarea id="description" name="description" class="d-none" required="required"> </textarea>
                                <small class="text-danger">{{ $errors->first('description') }}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input name="file" class="form-control" id="bannerImage" name="bannerImage"
                                    type="file">
                                <small class="text-danger">{{ $errors->first('file') }}</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                                    <small class="text-danger">{{ $errors->first('start_date') }}</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group {{ $errors->has('end_date') ? ' has-error' : '' }}">
                                    <label for="end_date">End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                                    <small class="text-danger">{{ $errors->first('end_date') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3 ">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="storeBtn" class="btn btn-primary">Save</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.9/dayjs.min.js"></script>
    <script src="{{ asset('falcon/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#description',
            height: 300,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });

        $("#reportsDateRange").change(function() {
            iklanTbl.ajax.reload();
        });

        var iklanTbl = $('#iklan-table').DataTable({
            "dom": '<"container-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('iklan.ajaxLoadIklan') }}',
                type: 'POST',
                data: function(d) {
                    d._token = '{{ csrf_token() }}';
                }
            },
            columns: [{
                    data: 'title',
                    name: 'title',
                },
                {
                    data: 'start_date',
                    name: 'start_date',
                },
                {
                    data: 'end_date',
                    name: 'end_date',
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center'
                },
                {
                    data: 'created_by',
                    name: 'created_by',
                },
                {
                    data: 'action',
                    name: 'action',
                    sortable: false
                }

            ]
        });

        $('#tmbhBtn').click(function(e) {
            e.preventDefault();
            resetForm();
            $('#mdl-iklan').modal('show');
        });

        $(document).on("click", ".edit", function(e) {
            e.preventDefault();
            var uuid = $(this).data('uuid');
            var url = "{{ route('iklan.edit', ['uuid' => ':uuid']) }}";
            url = url.replace(':uuid', uuid);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    var start_date = dayjs(data.start_date).format("YYYY-MM-DD");
                    var end_date = dayjs(data.end_date).format("YYYY-MM-DD");
                    $('#uuid').val(data.uuid);
                    $('#title').val(data.title);
                    if (tinymce.get('description')) {
                        tinymce.get('description').setContent(data.description);
                    }
                    $('#start_date').val(start_date);
                    $('#end_date').val(end_date);
                    $('#status').val(data.is_active);
                    $('#mdl-iklan').modal('show');
                }
            });
        });

        $('#storeBtn').click(function(e) {
            e.preventDefault();
            $('.is-invalid').removeClass('is-invalid');
            $('.text-danger').text('');
            var descval = tinymce.get('description').getContent();
            $('#description').val(descval);
            var form = $('#mdl-iklan form')[0];

            var formData = new FormData(form);
            var uuid = $('#uuid').val();
            if (uuid != null) {
                formData.append('_method', 'PUT');
                var url = "{{ route('iklan.update', ['uuid' => ':uuid']) }}";
                url = url.replace(':uuid', uuid);
            } else {
                var url = "{{ route('iklan.store') }}";
            }

            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        $('#mdl-iklan').modal('hide');
                        iklanTbl.ajax.reload();
                        swal("Success!", "The ads saved successfully", "success");
                        resetForm();
                    } else {
                        swal("Failed!", "The ads failed to be save", "error");
                    }
                },
                error: function(data) {
                    swal("Failed!", "The ads failed to be save", "error");
                    var errors = data.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        var el = $('#' + key);
                        el.addClass('is-invalid');
                        el.closest('.form-group').find('.text-danger').text(value);
                    });
                }
            });
        });

        function resetForm() {
            $('#mdl-iklan form')[0].reset();
        }

        $(document).on("click", ".delete", function(e) {

            var uuid = $(this).data('uuid');
            var url = "{{ route('iklan.destroy', ['uuid' => ':uuid']) }}";
            url = url.replace(':uuid', uuid);

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this advertisment record!",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancel",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Yes, i'm sure!",
                        value: true,
                        visible: true,
                        className: "btn-danger",
                        closeModal: true
                    }
                }
            }).then((value) => {
                if (value == true) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            swal("Deleted!", "The ads removed successfully", "success");
                            iklanTbl.ajax.reload();
                        }
                    });
                }
            });

        });
    </script>
@endsection
