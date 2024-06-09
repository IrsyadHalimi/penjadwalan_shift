<div>
    <label>Departemen:</label>
    <select wire:model="selectedDepartment">
        <option value="">Pilih Departemen</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
        @endforeach
    </select>
    
    @if (!empty($operators))
        <label>Operator:</label>
        <select>
            <option value="">Pilih Operator</option>
            @foreach($operators as $operator)
                <option value="{{ $operator->id }}">{{ $operator->operator_name_type }}</option>
            @endforeach
        </select>
    @endif
</div>
