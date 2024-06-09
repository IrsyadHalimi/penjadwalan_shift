<div>
    <div>
        <label for="department">Pilih Departemen:</label>
        <select wire:model="selectedDepartment" id="department">
            <option value="">Pilih Departemen</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>

    @if (!empty($selectedDepartment))
        <div>
            <label for="operator">Pilih Operator:</label>
            <select id="operator">
                <option value="">Pilih Operator</option>
                @foreach($operators as $operator)
                    <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>