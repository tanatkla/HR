<div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title">ตำแหน่ง</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <form method="post" action="{{ route('position.store') }}" accept-charset="UTF-8"> --}}
            {{-- @csrf --}}
        <div class="modal-body">
           {{-- <div class="container">
        <div class=""> --}}
            <div class="row justify-content-center">
                <div class="col-md-12">
                    
                        <div class="row">
                            <div class="col-2 mt-2">
                                <p>Position : </p>
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="Position" id="position_name"
                                    name="position_name" value="{{ isset($position) ? $position->position_name : null }}">
                            </div>
                            
                        </div>
                            <div class="row mt-3">
                                <div class="col-2 ">
                                    <p>Status : </p>
                                </div>
                            <div class="col-4 ">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input mt-1" type="radio" name="status" id="active"
                                        value="1" @if ($position->status == 1) checked @endif>
                                    <label class="form-check-label" for="active">{{ __('positions.status_1') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input mt-1" type="radio" name="status" id="inactive"
                                        value="0" @if ($position->status == 0) checked @endif>
                                    <label class="form-check-label" for="inactive">{{ __('positions.status_0') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end mt-3">
                                {{-- <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button> --}}
                                <input type="hidden" value="{{ isset($position) ? $position->id : null }}" id="id"
                                    name="id">
                            </div>
                        </div>
                    

                </div>
            {{-- </div>
        </div> --}}

    {{-- </div> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button> --}}
          <a class="btn btn-primary text-white save-form" data-route-store="{{ route('position.store') }}">Submit</a>
        </div>
    {{-- </form> --}}
      </div>
    </div>
  </div>