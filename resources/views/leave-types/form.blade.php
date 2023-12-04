@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('leave-type.store') }}" accept-charset="UTF-8">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            {{-- {{$dash->firstname}}
                            {{$sum}} --}}
                            <input type="text" class="form-control" placeholder="ชื่อประเภทวันลา" id="name"
                                name="name" value="{{ isset($leave_type) ? $leave_type->name : null }}" disabled>
                        </div>
                        <div class="col-auto mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="reset" name="reset">
                                <label class="form-check-label" for="flexCheckDefault">
                                    รีเซ็ตจำนวนวันลาของทุกคน
                                </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="password" class="form-control" placeholder="รหัสผ่าน" id="password"
                                name="password">
                        </div>
                        <div class="col">
                            {{-- <input type="text" class="form-control" placeholder="Position" id="position" name="position"
                                value="{{ isset($dash) ? $dash->position : null }}"> --}}
                            {{-- <select class="form-select" name="position">

                                <option hidden>Select Item</option>

                                @foreach ($leave_list as $item)
                                    <option value="{{ $item->id }}" @if (isset($leave)){{ ( $item->id == $leave->position_id) ? 'selected' : '' }} @endif> {{ $item->name }} </option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                    <input type="hidden" value="{{ isset($leave_type) ? $leave_type->id : null }}" id="id" name="id">


                </form>

            </div>
        </div>
    </div>
@endsection


{{-- @push('script') --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script> 
@vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}



@push('script')
    <!--Your JavaScript Assets or Code Goes Here -->

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

        $('#password').hide();
        $( "#reset" ).click(function() {
        if ($('#reset').is(":checked")) {
            $('#password').show();
        }else{
            $('#password').hide();
        }
    });
        // $('#lastname').hide();
    </script>
@endpush

{{-- @endpush --}}

{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
