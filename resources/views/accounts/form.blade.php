@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-8">
                <form method="post" action="{{ route('account.store') }}" accept-charset="UTF-8">
                    @csrf
                    <div class="row mb-3">
                        {{-- <select class="form-select" name="prefix">

                            <option hidden>Select Item</option>

                            @foreach ($position_list as $item)
                                <option value="{{ $item->id }}" @if (isset($dash)){{ ( $item->id == $dash->position_id) ? 'selected' : '' }} @endif> {{ $item->name }} </option>
                            @endforeach
                        </select> --}}
                        <div class="col">
                            <input type="text" class="form-control" placeholder="ชื่อ" id="firstname" name="firstname"
                                value="{{ isset($dash) ? $dash->firstname : null }}">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="นามสกุล" id="lastname" name="lastname"
                                value="{{ isset($dash) ? $dash->lastname : null }}">
                        </div>
                        <div class="col">
                            {{-- <input type="text" class="form-control" placeholder="Position" id="position" name="position"
                                value="{{ isset($dash) ? $dash->position : null }}"> --}}
                            <select class="form-select" name="position" id="position">

                                <option hidden>Select Item</option>

                                @foreach ($position_list as $item)
                                    <option value="{{ $item->id }}"
                                        @if (isset($dash)) {{ $item->id == $dash->position_id ? 'selected' : '' }} @endif>
                                        {{ $item->name }} </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" id="name" name="name"
                                value="{{ isset($dash) ? $dash->name : null }}">
                        </div>
                        <div class="col">
                            <input type="email" class="form-control" placeholder="อีเมล" id="email" name="email"
                                value="{{ isset($dash) ? $dash->email : null }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="input-group date">
                                <input type="" class="form-control date" name="start_job"
                                    id="start_job" value="{{ isset($dash) ? $dash->start_job : null }}" onkeydown="return false" autocomplete="off">
                                <span class="input-group-append">
                                    <span class="input-group-text bg-light d-block">
                                        <i class="far fa-calendar"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="รหัสผ่าน" id="password"
                                name="password">
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary generate" id="btn-submit"><i class="fas fa-sync"></i> Generate</button>
                        </div>
                    </div>
                    @if ( !isset($view) )
                        <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                        <input type="hidden" value="{{ isset($dash) ? $dash->id : null }}" id="id" name="id">
                    @endif



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
            $('#name').prop('disabled', true);
            $('#email').prop('disabled', true);
            $('#start_job').prop('disabled', true);
            $('#password').prop('disabled', true);
            $('#btn-submit').hide();

        }

        var check = '{{isset($dash->password)}}';
        if(check){
            $('#password').val('********');
            $('#password').attr('type', 'password'); 
        }else{
            var random = Math.floor(100000 + Math.random() * 900000);
            $('#password').val(random);
        }
        

        $(".generate").click(function() {
            var random = Math.floor(100000 + Math.random() * 900000);
            $('#password').val(random);
            $('#password').attr('type', 'text'); 
        });

        $("#start_job").flatpickr({
            dateFormat: "Y-m-d" ,
            allowInput: true,
            // time_24hr: true,
            // enableminute: false,
        });

        $(".flatpickr-minute").prop('disabled', true);

    </script>
@endpush

@push('styles')
    <style>
        .date {
            cursor: pointer;
        }
    </style>
@endpush
{{-- @endpush --}}

{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
