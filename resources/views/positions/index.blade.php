@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>จัดการตำแหน่ง</h2>
            </div>
            <div class="col-6 text-end mb-3">
                {{-- <a class="btn btn-primary" href="{{ route('position.create') }}">Create</a> --}}
                {{-- <a class="btn btn-primary" href="{{ route('position.create') }}">Create</a> --}}
                <button type="button" class="btn btn-primary" data-toggle="modal" onclick="openModal()"><i class="fas fa-plus-circle mr-1"></i>{{ __('actions.create') }}</button>

            </div>
            @include('positions.modals.position-modal')
        </div>
        <div class="card">
            <div class="card-body">
                <form method="get" action="{{ route('position.index') }}" accept-charset="UTF-8">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-3">
                            <input type="text" class="form-control" placeholder="Search" id="search" name="search" value="{{$search}}">
                        </div>
                        <div class="col-auto">
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
                            <th scope="col" class="font-weight-bold">ชื่อตำแหน่ง</th>
                            <th scope="col" class="font-weight-bold">สถานะ</th>
                            <th scope="col" class="font-weight-bold">เครื่องมือ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $index => $item)
                            <tr style="height: 50px;">
                                <th scope="row">{{ $lists->firstItem() + $index }}</th>
                                <td>{{ $item->position_name }}</td>
                                <td> <span class="badge badge badge-pill badge-{{ __('positions.class_' . $item->status) }}">{{ __('positions.status_' . $item->status) }}</span></td>
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
                                        <a class="dropdown-item" onclick="openModalEdit({{ $item->id }},true)"><i
                                                class="fa fa-eye mr-1" aria-hidden="true"></i>{{ __('actions.view') }}</a>
                                        <a class="dropdown-item" onclick="openModalEdit({{ $item->id }},false)"
                                            data-id="{{ $item->id }}"><i
                                                class="fas fa-edit mr-1"></i>{{ __('actions.edit') }}</a>
                                        @csrf
                                        <a class="dropdown-item deleteRecord"
                                            data-route-delete="{{ route('position.destroy', ['position' => $item->id]) }}"><i
                                                class="fas fa-trash-alt mr-1"></i>{{ __('actions.delete') }}</a>
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

@push('script')
    <!--Your JavaScript Assets or Code Goes Here -->

    <script>
        // console.log('dsfsdf');
        function openModal() {
            $('#exampleModalLong').modal('show');
        }

        function openModalEdit(id, status) {

            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: "{{ route('position.get-data-edit') }}",
                type: 'GET',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function(data) {
                    $('#position_name').prop('disabled', false);
                    $('input[type=radio]').prop('disabled', false);
                    $('#btn-submit').show();
                    $('#title').html('');

                    $("#active").attr('checked', false);
                    $("#inactive").attr('checked', false);
                    $('#position_name').val(data.data.position_name);
                    $('#id').val(data.data.id);
                    $('#title').html('แก้ไขตำแหน่ง');
                    if (data.data.status == 1) {
                        $("#active").attr('checked', 'checked');
                    } else {
                        $("#inactive").attr('checked', 'checked');
                    }
                    if (status) {
                        $('#position_name').prop('disabled', true);
                        $('input[type=radio]').prop('disabled', true);
                        $('#btn-submit').hide();
                        $('#title').html('ดูตำแหน่ง');
                    }

                    $('#exampleModalLong').modal('show');

                }
            });
        }

        $(".save-form").click(function() {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            var route_store = $(this).attr('data-route-store');

            let pass = null;
            console.log($('#position_name').val());
            if($('#position_name').val().length === 0 || $('input[name=status]:checked').val().length === 0){
                pass = false;
            }else{
                pass = true;
            }
          
                if (pass) {
                    var id = $(this).data("id");
                    var token = $("meta[name='csrf-token']").attr("content");

                    $.ajax({
                        url: route_store,
                        type: 'POST',
                        data: {
                            "position_name": $('#position_name').val(),
                            "id": $('#id').val(),
                            "status": $('input[name=status]:checked').val(),
                            "_token": token,
                        },
                        success: function() {
                            $('#exampleModalLong').modal('toggle');
                            Swal.fire(
                                'Saved!',
                                'บันทึกข้อมูลสำเร็จ!',
                                'success'
                            ).then(function() {
                                location.reload();
                            });
                        }
                    });
                }else{
                    Swal.fire(
                                'Warning!',
                                'กรุณากรอกข้อมูลให้ครบ',
                                'warning'
                    )
                }
            });
    </script>
@endpush
