@extends('layouts.app')

@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('leave.index') }}">จัดการใบลา</a></li>
                <li class="breadcrumb-item active" aria-current="page">สร้างใบลา</li>
            </ol>
        </nav>
        <div class="row justify-content-center">

            <div class="col-md-3 ">
                <div class="row mb-2 ">
                    <div class="card mx-auto">
                        <div class="card-body">
                            <h6 class="card-title">ลาป่วย</h6>
                            <h3 class="card-text"><i class="fa fa-heartbeat" aria-hidden="true" style="color: #FE5F55;"></i>
                                {{ intval($user->sick_leave) }} วัน @if ($user->sick_leave_hours > 0)
                                    {{ $user->sick_leave_hours }} ชม.
                                @endif / 30 วัน </h3>
                        </div>


                    </div>
                </div>
                <div class="row mb-2">
                    <div class="card mx-auto">
                        <div class="card-body">
                            <h6 class="card-title">ลากิจ</h6>
                            <h3 class="card-text"><i class="bi bi-person-workspace" style="color: #445E93;"></i>
                                {{ intval($user->personal_leave) }} วัน @if ($user->personal_leave_hours > 0)
                                    {{ $user->personal_leave_hours }} ชม.
                                @endif / 5 วัน</h3>
                        </div>

                    </div>
                </div>
                <div class="row mb-2">
                    <div class="card mx-auto">
                        <div class="card-body">
                            <h6 class="card-title">ลาพักร้อน</h6>
                            <h3 class="card-text"><i class="fa fa-plane" aria-hidden="true" style="color: #8380B6;"></i>
                                {{ intval($user->vacation_leave) }} วัน @if ($user->vacation_leave_hours > 0)
                                    {{ $user->vacation_leave_hours }} ชม.
                                @endif / {{ $user->vacation_leave_total }} วัน</h3>
                        </div>

                    </div>
                </div>
                <div class="row mb-2">
                    <div class="card mx-auto">
                        <div class="card-body">
                            <h6 class="card-title">ลาคลอด</h6>
                            <h3 class="card-text"><i class="bi bi-hearts" style="color: #05A8AA;"></i>
                                {{ intval($user->maternity_leave) }} วัน @if ($user->maternity_leave_hours > 0)
                                    {{ $user->maternity_leave_hours }} ชม.
                                @endif / 98 วัน</h3>
                        </div>

                    </div>
                </div>
                <div class="row mb-2">
                    <div class="card mx-auto">
                        <div class="card-body">
                            <h6 class="card-title">ลาฝึกอบรม</h6>
                            <h3 class="card-text"><i class="fa fa-certificate" aria-hidden="true"
                                    style="color:#F0B67F;"></i> {{ intval($user->training_leave) }} วัน @if ($user->training_leave_hours > 0)
                                    {{ $user->training_leave_hours }} ชม.
                                @endif / 10 วัน</h3>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card mx-auto h-100" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="text-center mb-4"><u>ฟอร์มแจ้งการลา</u></h5>
                        <form method="post" action="{{ route('leave.store') }}" accept-charset="UTF-8">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-2 mt-2">
                                    <label for="date" class="">ประเภทการลา :</label>
                                </div>
                                <div class="col-4">
                                    <select class="selectpicker" title="กรุณาเลือก" name="leave_type_id">
                                        <option hidden>กรุณาเลือก</option>
                                        @foreach ($leave_types_list as $item)
                                            <option value="{{ $item->id }}"
                                                @if (isset($leave)) {{ $item->id == $leave->leave_type_id ? 'selected' : '' }} @endif>
                                                {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-2 mt-2">
                                    <label for="date" class="">วันเริ่มต้นลา :</label>
                                </div>
                                <div class="col-4">
                                    <div class="input-group date">
                                        <input type="datetime-local" class="form-control date" name="leave_start_date" id="leave_start_date"
                                            value="{{ isset($leave) ? $leave->leave_start_date : null }}"
                                            onkeydown="return false" autocomplete="off">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                                <i class="far fa-calendar"></i>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-2 mt-2">
                                    <label for="date" class="">วันสิ้นสุดลา :</label>
                                </div>
                                <div class="col-4  ">
                                    <div class="input-group ">
                                        <input type="datetime-local" class="form-control date" name="leave_end_date" id="leave_end_date"
                                            value="{{ isset($leave) ? $leave->leave_end_date : null }}"
                                            onkeydown="return false" autocomplete="off">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                                <i class="far fa-calendar"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 mt-2">
                                    <label for="date" class="">เหตุผลการลา :</label>
                                </div>
                                <div class="col-10">
                                    {{-- {{($leave->leave_reason)}} --}}
                                    {{-- <input type="text" class="form-control" value="{{$leave->leave_reason}}"> --}}
                                    <textarea class="form-control" placeholder="เหตุผลการลา" id="leave_reason" name="leave_reason" rows="3">{{ isset($leave) ? $leave->leave_reason : null }}</textarea>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col  text-right">
                                    <button type="submit" class="btn btn-primary text-center"
                                        id="btn-submit">ยืนยันการส่งใบลา</button>
                                    <input type="hidden" value="{{ isset($leave) ? $leave->id : null }}" id="id"
                                        name="id">

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!--Your JavaScript Assets or Code Goes Here -->
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
    <script>
        // flatpickr("input[type=datetime-local]", {
        //     enableTime: true,
        //     dateFormat: "Y-m-d H:i",
        //     allowInput: true,
        //     minuteIncrement: 60,
        //     time_24hr: true,
        // });
        // date_picker.minuteElement.style.display = "none";
        // minutesInputWrapper.remove();
        // flatpickr("input[type=datetime-local]").minuteElement.style.display = "none";
    </script>
    <script>
        // console.log('dsfsdf');
        var isset_view = '{{ isset($view) }}';
        // console.log(isset_view);
        if (isset_view) {
            $('#firstname').prop('disabled', true);
            $('#lastname').prop('disabled', true);
            $('#position').prop('disabled', true);
            $('#btn-submit').hide();

        }

        $("#leave_start_date").flatpickr({
            defaultHour: "09",
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            allowInput: true,
            minuteIncrement: 60,
            time_24hr: true,
            // enableminute: false,
        });

        $("#leave_end_date").flatpickr({
            defaultHour: "18",
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            allowInput: true,
            minuteIncrement: 60,
            time_24hr: true,
        });

        $(".flatpickr-minute").prop('disabled', true);

        // $('#lastname').hide();
    </script>
@endpush

@push('styles')
    <style>
        .date {
            cursor: pointer;
        }
    </style>
@endpush
