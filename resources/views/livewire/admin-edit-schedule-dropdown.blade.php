<div>
    <label>Departemen:</label>
    <select wire:model="selectedDepartment" name="department_id">
        <option value="">Pilih Departemen</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ $department->id == $selectedDepartment ? 'selected' : null }}>{{ $department->department_name }}</option>
        @endforeach
    </select>

    <label>Jenis Operator:</label>
    <select wire:model="selectedOperatorType" name="operator_type_id">
        <option value="">Pilih Jenis Operator</option>
        @foreach($operatorTypes as $operatorType)
            <option value="{{ $operatorType->id }}" {{ $operatorType->id == $selectedOperatorType ? 'selected' : null }}>{{ $operatorType->operator_name_type }}</option>
        @endforeach
    </select>

    <label>Operator:</label>
    <select wire:model="selectedOperator" name="user_id">
        <option value="">Pilih Operator</option>
        @foreach($operators as $operator)
            <option value="{{ $operator->id }}" {{ $operator->id == $selectedOperator ? 'selected' : null }}>{{ $operator->full_name }}</option>
        @endforeach
    </select>

    <label>Shift:</label>
    <select wire:model="selectedShift" name="shift_id">
        <option value="">Pilih Shift</option>
        @foreach($shifts as $shift)
            <option value="{{ $shift->id }}" {{ $shift->id == $selectedShift ? 'selected' : null }}>{{ $shift->shift_name }}</option>
        @endforeach
    </select>
</div>
