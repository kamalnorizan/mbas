@extends('falcon.master')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
@endsection

@section('content')
    <div class="mb-3 card">
        <div class="bg-body-tertiary card-header">
            <div class="justify-content-between row">
                <div class="col">
                    <div class="d-flex">
                        <a class="d-flex" href="#">
                            <div class="avatar avatar-2xl status-online"><img class="rounded-circle "
                                    src="{{ asset('storage/profile/personal/' . $post->user->profile_picture) }}"
                                    alt=""></div>
                        </a>
                        <div class="flex-1 align-self-center ms-2">
                            <p class="mb-1 lh-1"><a class="fw-semibold" href="#">{{ $post->user->name }}</a><span
                                    class="ms-1">created a post
                                    <strong>{{ $post->title }}</strong></span></p>
                            <p class="mb-0 fs-10">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p>{!! $post->content !!}</p>
            <div class="row">
                @foreach ($post->images as $image)
                    <div class="col-md-2">
                        <img src="{{ asset('storage/uploads/' . $image->file_path) }}" alt="" class="img-fluid">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bg-body-tertiary pt-0 card-footer">
            <div class="border-bottom border-200 fs-10 py-3">
                <a class="text-700 me-1" href="#">{{ $post->like_count }} likes</a>
            </div>
            <div class="g-0 fw-semibold text-center py-2 fs-10 row">
                <div class="col-auto">
                    <div class="d-flex align-items-center rounded text-700 me-3 cursor-pointer"><img
                            src="data:image/png;base64,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"
                            alt="" width="20"><span class="ms-1">Like</span></div>
                </div>
            </div>
            <form class="">
                <div class="d-flex align-items-center border-top border-200 pt-3">
                    <div class="avatar avatar-xl "><img class="rounded-circle "
                            src="{{ Auth::check() ? asset('storage/profile/personal/' . Auth::user()->profile_picture) : asset('storage/profile/personal/avatar.png') }}"
                            alt=""></div>

                    <input placeholder="@guest Please login to write a comment @else Write a comment... @endguest "
                        type="text" @guest disabled @endguest data-post="{{ $post->uuid }}"
                        class="rounded-pill ms-2 fs-10 form-control commentInput" value="">
                </div>
            </form>
            @foreach ($post->comments as $comment)
                <div class="d-flex mt-3">
                    <a href="#">
                        <div class="avatar avatar-xl "><img class="rounded-circle "
                                src="{{ asset('storage/profile/personal/' . $comment->user->profile_picture) }}"
                                alt="">
                        </div>
                    </a>
                    <div class="flex-1 ms-2 fs-10">
                        <p class="mb-1 bg-200 rounded-3 p-2"><a class="fw-semibold"
                                href="{{ asset('storage/profile/personal/' . $comment->user->profile_picture) }}">{{ $comment->user->name }}</a>
                        </p>
                        <span class="ms-1">{{ $comment->content }}</span>
                        <div class="px-2"><a href="#!">Like</a> • <a href="#!">Reply</a> •
                            {{ $comment->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.commentInput').on('keypress', function(e) {
            var comment = $(this).val();
            var post = $(this).data('post');
            if (e.which === 13) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{ route('comments.store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        content: comment,
                        post_uuid: post
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            }
        });
    </script>
@endsection
