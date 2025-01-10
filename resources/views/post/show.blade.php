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
                    <h5 class="mb-0">{{$post->title}}</h5>
                        Author: {{$post->user->name}} | {{\Carbon\Carbon::parse($post->created_at)->format('d-m-Y')}} <br>
                        Category: {{$post->category->name}}
                </div>
            </div>
        </div>
        <div class="card-body position-relative bg-body-tertiary">
            <div class="row">
                <div class="col-lg-12">
                    {{ $post->content }}
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header border-bottom">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Comments</h5>
                </div>
            </div>
        </div>
        <div class="card-body position-relative bg-body-tertiary">
            @foreach ($post->comments as $comment)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-header border-bottom">
                                <div class="row flex-between-end">
                                    <div class="col-auto align-self-center">
                                        <h5 class="mb-0">{{$comment->user->name}}</h5>
                                        {{\Carbon\Carbon::parse($comment->created_at)->format('d-m-Y')}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body position-relative bg-body-tertiary">
                                {{ $comment->content }}
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_uuid" value="{{$post->uuid}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                                    <textarea placeholder="Enter your message here..." rows="5" id="content" name="content" class="form-control"
                                    >{{ old('content') }} </textarea>
                                    <small class="text-danger">{{ $errors->first('content') }}</small> <br>
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
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
@endsection
