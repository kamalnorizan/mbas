@extends('falcon.master')
@section('content')

<div class="card">
    <div class="card-body">
        @can('create post')
            <a href="{{ url('/post-create') }}" class="btn btn-primary mb-1">Tambah</a>
        @endcan

        <table class="table table-bordered table-hover table-striped table-sm">
            <thead class="table-dark">
                <tr>
                    <th>Bil</th>
                    <th>Tajuk</th>
                    <th>Slug</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->slug }}</td>
                    <td width='30%'>
                        <a href="{{ url('/post-edit/'.$p->id) }}" class="btn btn-success">Edit</a>
                        @can('delete post')
                        <a href="{{ url('/post-delete/'.$p->id) }}" class="btn btn-danger">Delete</a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
