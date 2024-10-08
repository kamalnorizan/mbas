@extends('falcon.master')
@section('content')

<div class="card">
    <div class="card-body">
        <!-- papar error disini jika ada -->
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{ $err }} <br>
                @endforeach
            </div>
        @endif

        <form action="{{ url('/post-save') }}" method="post">
            @csrf <!-- cross site request forgery -->

            <input type="hidden" name="id" value="{{ old('id', $p->id) }}">

            Title
            <input name="title" value="{{ old('title', $p->title) }}"
            type="text" class="form-control">

            slug
            <input name="slug" value="{{ old('slug', $p->slug) }}"
            type="text" class="form-control">

            <input type="submit" value="Save" class="btn btn-primary mt-1">
        </form>
    </div>
</div>
@endsection
