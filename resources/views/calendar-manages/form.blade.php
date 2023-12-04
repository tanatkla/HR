@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('calendar-manage.index') }}">จัดการตารางปฏิทิน</a></li>
                    <li class="breadcrumb-item active" aria-current="page">สร้างกิจกรรม</li>
                </ol>
            </nav>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
    <form method="post" action="{{ route('calendar-manage.store') }}" accept-charset="UTF-8">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-2 mt-2">
                                    <label for="date" class="">ชื่อ Calendar :</label>
                                </div>
                                {{-- @dd($calendar) --}}
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="ชื่อ Calendar" id="title"
                                        name="title" value="{{ isset($calendar) ? $calendar->title : null }}">
                                </div>
                                {{-- <div class="col">
                                <input type="text" class="form-control" placeholder="นามสกุล" id="lastname" name="lastname"
                                    value="{{ isset($calendar) ? $calendar->lastname : null }}">
                            </div> --}}


                            </div>
                            <div class="row mb-4">
                                <div class="col-2 mt-2">
                                    <label for="date" class="">วันเริ่มต้น :</label>
                                </div>
                                <div class="col-4">
                                    <div class="input-group date">
                                        <input class="form-control date" name="start_date" id="start_date"
                                            value="{{ isset($calendar) ? $calendar->start : null }}" onkeydown="return false"
                                            autocomplete="off">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                                <i class="far fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-2 mt-2">
                                    <label for="date" class="">วันสิ้นสุด :</label>
                                </div>
                                <div class="col-4  ">
                                    <div class="input-group ">
                                        <input class="form-control date" name="end_date" id="end_date"
                                            value="{{ isset($calendar) ? $calendar->end : null }}" onkeydown="return false"
                                            autocomplete="off">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                                <i class="far fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-2 mt-2">
                                    <label for="date" class="">สี Label :</label>
                                </div>
                                {{-- <div class="col-5">
                                <input type="color" class="form-control " placeholder="ddd" id="title" name="title"
                                    value="{{ isset($calendar) ? $calendar->title : "#EFBEBE" }}">
                                    
                            </div> --}}

                                <div class="col-2">
                                    <input type="color" class="form-control" id="color" name="color"
                                        value="{{ isset($calendar) ? $calendar->color : '#FE5F55' }}" list="lists" />

                                    <datalist id="lists">
                                        <option>#FE5F55</option>
                                        <option>#F0B67F</option>
                                        <option>#05A8AA</option>
                                        <option>#8380B6</option>
                                        <option>#445E93</option>
                                    </datalist>
                                </div>
                                {{-- <div class="col-7">
                                <input type="text" class="form-control" placeholder="นามสกุล" id="lastname" name="lastname"
                                    value="{{ isset($calendar) ? $calendar->lastname : null }}">
                            </div> --}}


                            </div>

                            <button type="submit" class="btn btn-primary" id="btn-submit">{{ __('actions.submit') }}</button>
                            <input type="hidden" value="{{ isset($calendar) ? $calendar->id : null }}" id="id"
                                name="id">


                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


{{-- @push('script') --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script> 
@vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}



@push('script')
    <!--Your JavaScript Assets or Code Goes Here -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
    <script>
        // console.log('dsfsdf');
        var isset_view = '{{ isset($view) }}';
        // console.log(isset_view);
        if (isset_view) {
            $('#title').prop('disabled', true);
            $('#start_date').prop('disabled', true);
            $('#end_date').prop('disabled', true);
            $('#btn-submit').hide();

        }



        $(".generate").click(function() {
            var random = Math.floor(100000 + Math.random() * 900000);
            $('#password').val(random);
            $('#password').attr('type', 'text');
        });

        $("#start_date").flatpickr({
            defaultHour: "09",
            enableTime: false,
            dateFormat: "Y-m-d",
            allowInput: true,
            minuteIncrement: 60,
            time_24hr: true,
            // enableminute: false,
        });

        $("#end_date").flatpickr({
            defaultHour: "18",
            enableTime: false,
            dateFormat: "Y-m-d",
            allowInput: true,
            minuteIncrement: 60,
            time_24hr: true,
        });
    </script>
@endpush

{{-- @endpush --}}

{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}

@push('styles')
    <style>

    </style>
@endpush
