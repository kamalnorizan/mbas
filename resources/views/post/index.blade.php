@extends('falcon.master')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
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
                @can('create-post')
                    <div class="col-auto ms-auto">
                        <a class="btn btn-primary" href="{{ route('posts.create') }}"><i class="fa fa-plus"
                                aria-hidden="true"></i> Create New Post</a>
                    </div>
                @endcan
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('categories[]') ? 'has-error' : '' }}">
                        <label for="categories[]">Category</label>
                        <select id="categories" name="categories[]" class="form-control" required multiple>
                            <option value="">Select Category</option>
                            @foreach ($categories as $key=>$category)
                                <option value="{{ $key }}">{{ $category }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('categories[]') }}</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('author[]') ? 'has-error' : '' }}">
                        <label for="author[]">Author</label>
                        <select id="author" name="author[]" class="form-control" required multiple>
                            <option value="">Select Author</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->user_id }}">{{ $author->user->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('author[]') }}</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="status">Status</label>
                        <select id="status" name="status[]" class="form-control" required multiple>
                            <option value="">Select status</option>
                            <option value="1">Published</option>
                            @canany(['edit-post','create-post'])
                            <option value="0">Draft</option>
                            @endcanany
                            @can('publish-post')
                            <option value="2">Approval</option>
                            @endcan
                        </select>
                        <small class="text-danger">{{ $errors->first('status') }}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body position-relative  bg-body-tertiary">

            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-hover display responsive" id="post-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>View</th>
                                <th>Status</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>

        $('#categories').select2({
            placeholder: 'Select Category',
            allowClear: true
        });

        $('#author').select2({
            placeholder: 'Select Author',
            allowClear: true
        });

        $('#status').select2({
            placeholder: 'Select Category',
            allowClear: true
        });

        var postTbl = $('#post-table').DataTable({
            "responsive": true,
            "dom": '<"container-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('posts.ajaxLoadPosts') }}',
                type: 'POST',
                data: function(d) {
                    d._token = '{{ csrf_token() }}';
                    d.status = $('#status').val();
                    d.categories = $('#categories').val();
                    d.author = $('#author').val();
                }
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
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        $(document).on("click", ".delete", function(e) {
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
                            success: function(data) {
                                swal("Poof! Your data has been deleted!", {
                                    icon: "success",
                                });
                                postTbl.ajax.reload();
                            },
                            error: function(data) {
                                swal("Poof! Your data can't be deleted!", {
                                    icon: "error",
                                });
                            }
                        });
                    }
                });
        });

        $('#categories, #author, #status').on('change', function() {
            postTbl.ajax.reload();
        });
    </script>
@endsection
