@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('position.store') }}" accept-charset="UTF-8">
                        @csrf
                        <div class="row">
                            <div class="col-auto mt-2">
                                <p>Position : </p>
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="Position" id="position_name"
                                    name="position_name" value="{{ isset($position) ? $position->position_name : null }}">
                            </div>
                            <div class="col-auto mt-2">
                                <p>Status : </p>
                            </div>
                            <div class="col-4 mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                        value="1" @if ($position->status == 1) checked @endif>
                                    <label class="form-check-label" for="active">{{ __('positions.status_1') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                        value="0" @if ($position->status == 0) checked @endif>
                                    <label class="form-check-label" for="inactive">{{ __('positions.status_0') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end mt-3">
                                <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                                <input type="hidden" value="{{ isset($position) ? $position->id : null }}" id="id"
                                    name="id">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection



@push('script')
    <!--Your JavaScript Assets or Code Goes Here -->

    <script>
        // console.log('dsfsdf');
        var isset_view = '{{ isset($view) }}';
        // console.log(isset_view);
        if (isset_view) {
            $('#position_name').prop('disabled', true);
            $('input[type=radio]').prop('disabled', true);
            $('#btn-submit').hide();

        }

        
       

      


        // $('#lastname').hide();
    </script>
@endpush

{{-- @endpush --}}

{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
