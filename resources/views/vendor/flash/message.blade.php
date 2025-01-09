@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert alert-{{ $message['level'] }} {{ $message['important'] ? 'alert-important' : '' }} border-0 d-flex align-items-center" role="alert" >

            <p class="mb-0 flex-1">{!! $message['message'] !!}</p>
            {{-- @if ($message['important'])
                <button type="button"
                        class="btn-close float-end"
                        data-dismiss="alert"
                        aria-hidden="true"
                ></button>
            @endif --}}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
