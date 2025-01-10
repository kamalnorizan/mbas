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
                    <h5 class="mb-0" data-anchor="data-anchor" id="responsive-table">Update Post<a
                            class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#responsive-table"
                            style="margin-left: 0.1875em; padding-right: 0.1875em; padding-left: 0.1875em;"></a></h5>
                </div>
            </div>
        </div>
        <div class="card-body position-relative bg-body-tertiary">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('posts.update',['uuid'=>$post->uuid]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                    <select type="text" id="category_id" name="category_id" value="{{ old('category_id') }}"
                                        class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option {{ old('category_id',$post->category_id) == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <input type="text" id="title" name="title" value="{{ old('title',$post->title) }}"
                                        class="form-control" placeholder="Title">
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                </div>
                            </div>
                            <div class="col-md-12  mt-3">
                                <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                                    <textarea placeholder="Enter your message here..." rows="20" id="content" name="content" class="form-control"
                                    >{{ old('content',$post->content) }} </textarea>
                                    <small class="text-danger">{{ $errors->first('content') }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <a href="/storage/posts/{{$post->image}}" target="_blank">{{$post->image}}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <input name="file" class="form-control" id="customFile" type="file">
                                    <small class="text-muted">Upload file to replace the old file if exist</small>
                                    <small class="text-danger">{{ $errors->first('file') }}</small>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary float-end">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
