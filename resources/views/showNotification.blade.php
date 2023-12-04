@extends('layouts.app')

@section('content')
{{-- <div class="dropdown-menu dropdown-menu-right" role="alert" aria-labelledby="navbarDropdownMenuLink"> --}}
    @if ($notifications->count() > 0 )
    @foreach($notifications as $notification)
    <div class="alert alert-light" role="alert">
       <p class="dropdown-item"><b> {{ $notification->data['name'] }} </b>&nbsp; ({{ $notification->data['email'] }}) has just registered.   [{{  date('j \\ F Y, g:i A', strtotime($notification->created_at)) }}]</p>
       <a href="#"><button type="button" rel="tooltip" title="Mark as read" class="btn btn-danger btn-link btn-sm mark-as-read" data-id="{{ $notification->id }}">
       <i class="material-icons">close</i>
       </button>
       </a>
    </div>
    <hr>
    @endforeach
    <a href="#" class="dropdown-item" id="mark-all">
    Mark all as read
    </a>
    @else
    <p class="dropdown-item">There are no new notifications</p>
    @endif
 {{-- </div> --}}
 @endsection
 @push('script')
 <script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('markNotification') }}", {
            method: 'POST',
           
            data: {
              _token: '{{ csrf_token() }}',
                id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').remove();
            })
        });
    });

//     setInterval( function () {
//         location.reload();
// }, 30000 );

  </script>
  @endpush
 