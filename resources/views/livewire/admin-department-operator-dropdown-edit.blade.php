<div>
    <label>Departemen:</label>
    <select wire:model="selectedDepartment" name="department_id">
        <option value="">Pilih Departemen</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ $department->id == $selectedDepartment ? 'selected' : null }}>{{ $department->department_name }}</option>
        @endforeach
    </select>

    <label>Operator:</label>
    <select wire:model="selectedOperatorType" name="operator_type_id">
        <option value="">Pilih Operator</option>
        @foreach($operatorTypes as $operatorType)
            <option value="{{ $operatorType->id }}" {{ $operatorType->id == $selectedOperatorType ? 'selected' : null }}>{{ $operatorType->operator_name_type }}</option>
        @endforeach
    </select>
</div>
