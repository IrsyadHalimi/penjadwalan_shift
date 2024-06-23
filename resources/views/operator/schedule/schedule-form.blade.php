<x-modal-action-operator action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="start_date" readonly value="{{ $data->start_date ?? request()->start_date }}" class="form-control datepicker">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="end_date" readonly value="{{ $data->end_date ?? request()->end_date }}" class="form-control datepicker">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div>
                    <select name="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->getId() }}" @if($user->getId() == $data->user_id) selected @endif>{{ $user->getName() }}</option>
                    @endforeach
                    </select>    
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div>
                    <select name="shift_id">
                    @foreach($shifts as $shift)
                        <option value="{{ $shift->getId() }}" @if($shift->getId() == $data->shift_id) selected @endif>{{ $shift->getShiftName() }}</option>
                    @endforeach
                    </select>    
                </div>
            </div>
        </div>
    </div>
</x-modal-action-operator>