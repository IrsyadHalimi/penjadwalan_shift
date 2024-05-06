<x-modal-action action="{{ $action }}">
    @if ($data->id_jadwal)
        @method('put')
    @endif
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="tanggal_mulai" readonly value="{{ $data->tanggal_mulai ?? request()->tanggal_mulai }}" class="form-control datepicker">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="tanggal_selesai" readonly value="{{ $data->tanggal_selesai ?? request()->tanggal_selesai }}" class="form-control datepicker">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div>
                    <select name="id_user">
                    @foreach($user as $users)
                        <option value="{{ $users->getId() }}" @if($users->getId() == $data->id_user) selected @endif>{{ $users->getName() }}</option>
                    @endforeach
                    </select>    
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div>
                    <select name="id_shift">
                    @foreach($shift as $shifts)
                        <option value="{{ $shifts->getId() }}" @if($shifts->getId() == $data->id_shift) selected @endif>{{ $shifts->getShiftName() }}</option>
                    @endforeach
                    </select>    
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="delete" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Delete</label>
                  </div>
            </div>
        </div>
    </div>
</x-modal-action>