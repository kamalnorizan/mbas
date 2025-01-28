@extends('falcon.master')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
@endsection

@section('content')
    <div class="card mb-3">

        <div class="card-header border-bottom">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0" data-anchor="data-anchor" id="responsive-table">Create New Post<a
                            class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#responsive-table"
                            style="margin-left: 0.1875em; padding-right: 0.1875em; padding-left: 0.1875em;"></a></h5>
                </div>
            </div>
        </div>
        <div class="card-body position-relative bg-body-tertiary">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                    <select type="text" id="category_id" name="category_id"
                                        value="{{ old('category_id') }}" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                                        class="form-control" placeholder="Title">
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                </div>
                            </div>
                            <div class="col-md-12  mt-3">
                                <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                                    <textarea placeholder="Create a new post" rows="20" id="content" name="content" class="form-control">{{ old('content') }} </textarea>
                                    <small class="text-danger">{{ $errors->first('content') }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <input name="file[]" class="form-control file" id="file.0" type="file">
                                    <small class="text-danger">{{ $errors->first('file') }}</small>
                                </div>
                            </div>
                            <div id="filediv">

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                        <select type="text" id="status" name="status"
                                            value="{{ old('status') }}" class="form-control">
                                            <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Draft</option>
                                            @can('publish-post')
                                                <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Publish</option>
                                            @endcan
                                            <option {{ old('status') == 2 ? 'selected' : '' }} value="2">Submit</option>

                                        </select>
                                        <small class="text-danger">{{ $errors->first('status') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="float-end">
                                    <button id="newFile" type="button" class="btn btn-info ">Add New File</button>
                                    <button type="button" id="submitBtn" class="btn btn-primary ">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('falcon/vendors/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#content',
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

        $('#newFile').click(function(e) {
            e.preventDefault();
            var count = $('.file').length;
            $('#filediv').append(
                '<div class="row"><div class="col-md-11 mt-3"><input name="file[]" class="form-control file" id="file.'+count+'" type="file"><small class="text-danger">{{ $errors->first('file') }}</small></div><div class="col-md-1 mt-3"><button type="button" class="btn btn-block btn-danger del"> <i class="fa fa-trash" aria-hidden="true"></i> </button></div>'
                );
        });

        $('#submitBtn').click(function (e) {
            e.preventDefault();
            $('input').removeClass('is-invalid');
            $('select').removeClass('is-invalid');
            $('small.text-danger').remove();

            var form = $('form')[0];
            var formData = new FormData(form);
            formData.append('contenttiny', tinymce.get('content').getContent());
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                type: "POST",
                url: "{{ route('posts.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        window.location.href = "{{ route('posts.index') }}";
                    }
                },
                error: function (response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $(`#${key}`).addClass('is-invalid');
                        $(`#${key}`).parent().append(`<small class="text-danger">${value}</small>`);
                        if(key=='contenttiny'){
                            $('.tox-tinymce').parent().append(`<small class="text-danger">${value}</small>`);
                        }
                        if (key.includes('file.')) {
                            var id = key.split('.')[1];
                            $(`#file\\.${id}`).addClass('is-invalid');
                            $(`#file\\.${id}`).parent().append(`<small class="text-danger">${value}</small>`);
                        }
                    });
                }
            });
        });

        $(document).on("click", ".del", function(e) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this file!",
                icon: "warning",
                buttons: {cancel: {
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
                    className: "bg-danger",
                    closeModal: true
                }}
            }).then((value)=>{
                // alert(value);
                if(value==true){
                    $(this).parent().parent().remove();
                }
            });
        });
    </script>
@endsection
