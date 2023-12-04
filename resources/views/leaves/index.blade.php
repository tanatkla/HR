@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>จัดการใบลา</h2>
            </div>
            <div class="col-6 text-end mb-3">
                <a class="btn btn-primary" href="{{ route('leave.create') }}"><i
                        class="fas fa-plus-circle mr-1"></i>{{ __('actions.create') }}</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                {{-- <form method="get" action="{{ route('leave-type.index') }}" accept-charset="UTF-8">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            
                        </div>
                        <div class="col-1 mb-3">
                            <button type="submit" class="btn btn-primary" style="width: 80px;"
                                id="">{{ __('actions.search') }}</button>
                        </div>

                    </div>
                </form> --}}
                <form id="save-form">
                    <button type="button" class="btn btn-primary mb-3 button-check ConfirmRecord" id="btn-submit"
                        name="status" value="1">อนุมัติ</button>
                    <button type="button" class="btn btn-primary mb-3 button-check ConfirmRecord" id="btn-submit"
                        name="status" value="2">ไม่อนุมัติ</button>
                    {{-- <a class="btn ConfirmRecord" data-route-delete="{{ route('leave.update-status') }}">
                        <i class="fas fa-trash-alt mr-1"></i>{{ __('actions.delete') }}
                    </a> --}}

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @if (Auth::user()->position_id == 1)
                                    <th scope="col" class="">&nbsp;<input class="form-check-input" type="checkbox"
                                            value="" name="check_all" id="selectall"></th>
                                @endif
                                <th scope="col" class="font-weight-bold">#</th>
                                <th scope="col" class="font-weight-bold" style="width:210px;">วันที่</th>
                                <th scope="col" class="font-weight-bold" style="width:120px;">ประเภทการลา</th>
                                <th scope="col" class="font-weight-bold" style="width:330px;">เหตุผลการลา</th>
                                <th scope="col" class="font-weight-bold" style="width:180px;">ชื่อผู้ลา</th>
                                <th scope="col" class="font-weight-bold">สถานะการอนุมัติ</th>
                                <th scope="col" class="font-weight-bold">เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $index => $item)
                                <tr style="height: 50px;">
                                    @if (Auth::user()->position_id == 1)
                                        <td>
                                            @if ($item->status == 3)
                                                &nbsp; <input class="form-check-input selectedId" type="checkbox"
                                                    value="1" name="check[{{ $item->id }}]" id="flexCheckDefault">
                                            @endif
                                        </td>
                                    @endif
                                    <td scope="row">{{ $lists->firstItem() + $index }}</td>
                                    {{-- <td>@if ($item->leave_start_date != $item->leave_end_date)  {{Helper::DateThai($item->leave_start_date)}} <i class="bi bi-arrow-right-short"></i> {{Helper::DateThai($item->leave_end_date)}} @else {{Helper::DateThai($item->leave_start_date)}} @endif --}}
                                    @if (Helper::DateThaiNoTime($item->leave_start_date) == Helper::DateThaiNoTime($item->leave_end_date))
                                        <td>{{ Helper::DateThaiNoTime($item->leave_start_date) }} <br> ( {{Helper::Time($item->leave_start_date)}} <i class="bi bi-arrow-right-short"></i> {{Helper::Time($item->leave_end_date)}})</td>
                                    @else
                                    <td>{{ Helper::DateThaiNoTime($item->leave_start_date) }} <i class="bi bi-arrow-right-short"></i> {{ Helper::DateThaiNoTime($item->leave_end_date) }} <br> ( {{Helper::Time($item->leave_start_date)}} <i class="bi bi-arrow-right-short"></i> {{Helper::Time($item->leave_end_date)}})</td>

                                    @endif
                                    <td>{{ $item->leave_type_name }} </td>
                                    <td>{{ $item->leave_reason }}</td>
                                    <td>{{ $item->firstname }} {{ $item->lastname }}</td>
                                    <td> <span
                                            class="w-50 text-center badge badge-pill badge-{{ __('leaves.class_' . $item->status) }}">{{ __('leaves.status_' . $item->status) }}</span>
                                    </td>

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
                                            <a class="dropdown-item" href="{{ route('leave.show', $item->id) }}">
                                                <i class="fa fa-eye mr-1" aria-hidden="true"></i>{{ __('actions.view') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('leave.edit', $item->id) }}">
                                                <i class="fas fa-edit mr-1"></i>{{ __('actions.edit') }}
                                            </a>
                                            @csrf

                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                <div class="d-flex justify-content-center">
                    {!! $lists->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.button-check').hide();
            $('#selectall').click(function() {
                $('.selectedId').prop('checked', this.checked);
                if ($('input[name=check_all]').prop('checked') == true) {
                    // console.log('dfdf');
                    $('.button-check').show();
                } else {
                    // console.log('sdsd');
                    $('.button-check').hide();
                }

            });

            $('.selectedId').change(function() {
                var check = ($('.selectedId').filter(":checked").length == $('.selectedId').length);
                $('#selectall').prop("checked", check);
                $('.button-check').show();
                if ($('.selectedId').filter(":checked").length == 0) {
                    $('.button-check').hide();
                }
            });
        });
    </script>
@endpush


{{-- @include('layouts.delete') --}}
@include('layouts.confirm', [
    'store_uri' => route('leave.update-status'),
])
