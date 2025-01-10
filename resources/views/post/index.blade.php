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
    </style>
@endsection

@section('content')
    <div class="card mb-3">

        <div class="card-header border-bottom">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0" data-anchor="data-anchor" id="responsive-table">Post List<a class="anchorjs-link "
                            aria-label="Anchor" data-anchorjs-icon="#" href="#responsive-table"
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
                            <table class="table table-hover" id="post-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>View</th>
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
        var postTbl = $('#post-table').DataTable({
            "dom": '<"container-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('posts.index') }}',
                type: 'GET'
            },
            columns: [{
                    data: null,
                    name: 'row_number',
                    render: function(data, type, row, meta) {
                        return meta.row + 1 + meta.settings._iDisplayStart;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'author',
                    name: 'user.name'
                },
                {
                    data: 'views',
                    name: 'view_count'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        $(document).on("click",".delete",function (e) {
            e.preventDefault();
            var id = $(this).data('uuid');
            var url = '{{ route('posts.destroy', ':id') }}';
            url = url.replace(':id', id);
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function (data) {
                            swal("Poof! Your data has been deleted!", {
                                icon: "success",
                            });
                            postTbl.ajax.reload();
                        },
                        error: function (data) {
                            swal("Poof! Your data can't be deleted!", {
                                icon: "error",
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
