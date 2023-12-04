@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>จัดการตารางปฏิทิน</h2>
            </div>
            <div class="col-6 text-end mb-3">
                <a class="btn btn-primary" href="{{ route('calendar-manage.create') }}"><i
                        class="fas fa-plus-circle mr-1"></i>{{ __('actions.create') }}</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="get" action="{{ route('calendar-manage.index') }}" accept-charset="UTF-8">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <input type="text" class="form-control" placeholder="กิจกรรม / รหัสสี" id="s" name="s"
                                value="{{ $s }}">
                        </div>
                        <div class="col-1 mb-3">
                            <button type="submit" class="btn btn-primary" style="width: 80px;" id="">{{ __('actions.search') }}</button>
                        </div>
                        <div class="col-auto">
                            <a href="{{URL::Current()}}" class="btn btn-secondary" style="width: 80px;" id="">{{ __('actions.reset') }}</a>
                        </div>

                    </div>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="font-weight-bold">#</th>
                            <th scope="col" class="font-weight-bold">วันที่</th>
                            <th scope="col" class="font-weight-bold">กิจกรรม</th>
                            <th scope="col" class="font-weight-bold">สี</th>
                            <th scope="col" class="font-weight-bold">เครื่องมือ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $index => $item)
                            <tr style="height: 50px;">
                                <td scope="row">{{ $lists->firstItem() + $index }}</td>
                                <td>@if($item->start != $item->end)  {{Helper::DateThaiNoTime($item->start)}} <i class="bi bi-arrow-right-short"></i> {{Helper::DateThaiNoTime($item->end)}} @else {{Helper::DateThaiNoTime($item->start) }} @endif
                                </td>
                                <td>{{ $item->title }}</td>
                                <td><div class="text-center" style="width: 50%; background-color: {{$item->color}}; border-radius: 10px;"><span class="text-gray" style="mix-blend-mode: difference;">{{ $item->color }}</span></div></td>
                                <td>
                                    <a class="dropdown" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.5 13C9.5 13.3978 9.34196 13.7794 9.06066 14.0607C8.77936 14.342 8.39782 14.5 8 14.5C7.60218 14.5 7.22064 14.342 6.93934 14.0607C6.65804 13.7794 6.5 13.3978 6.5 13C6.5 12.6022 6.65804 12.2206 6.93934 11.9393C7.22064 11.658 7.60218 11.5 8 11.5C8.39782 11.5 8.77936 11.658 9.06066 11.9393C9.34196 12.2206 9.5 12.6022 9.5 13ZM9.5 8C9.5 8.39782 9.34196 8.77936 9.06066 9.06066C8.77936 9.34196 8.39782 9.5 8 9.5C7.60218 9.5 7.22064 9.34196 6.93934 9.06066C6.65804 8.77936 6.5 8.39782 6.5 8C6.5 7.60218 6.65804 7.22064 6.93934 6.93934C7.22064 6.65804 7.60218 6.5 8 6.5C8.39782 6.5 8.77936 6.65804 9.06066 6.93934C9.34196 7.22064 9.5 7.60218 9.5 8ZM9.5 3C9.5 3.39782 9.34196 3.77936 9.06066 4.06066C8.77936 4.34196 8.39782 4.5 8 4.5C7.60218 4.5 7.22064 4.34196 6.93934 4.06066C6.65804 3.77936 6.5 3.39782 6.5 3C6.5 2.60218 6.65804 2.22064 6.93934 1.93934C7.22064 1.65804 7.60218 1.5 8 1.5C8.39782 1.5 8.77936 1.65804 9.06066 1.93934C9.34196 2.22064 9.5 2.60218 9.5 3Z"
                                                fill="#15123F" />
                                        </svg>
                                    </a>
                                    @csrf
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('calendar-manage.show', $item->id) }}">
                                            <i class="fa fa-eye mr-1" aria-hidden="true"></i>{{ __('actions.view') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('calendar-manage.edit', $item->id) }}">
                                            <i class="fas fa-edit mr-1"></i>{{ __('actions.edit') }}
                                        </a>
                                        @csrf
                                        <a class="dropdown-item deleteRecord" data-route-delete="{{ route('calendar-manage.destroy', ['calendar_manage' => $item->id]) }}">
                                            <i class="fas fa-trash-alt mr-1"></i>{{ __('actions.delete') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $lists->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection


@include('layouts.delete')
