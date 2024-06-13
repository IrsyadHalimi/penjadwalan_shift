<div>
    <label>Departemen:</label>
    <select wire:model="selectedDepartment" name="department_id">
        <option value="">Pilih Departemen</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
        @endforeach
    </select>

    <label>Operator:</label>
    <select wire:model="selectedOperator" name="operator_type_id">
        <option value="">Pilih Operator</option>
        @foreach($operators as $operator)
            <option value="{{ $operator->id }}">{{ $operator->operator_name_type }}</option>
        @endforeach
    </select>
</div>
