<div class="row">
    <div class="col-md-4">
        <label for="department-horizontal">Departemen</label>
    </div>
    <div class="col-md-8 form-group">  
        <select wire:model="selectedDepartment" name="department_id" class="form-select @error('department_id') is-invalid @enderror" id="basicSelect">
            <option value="" hidden>-- Pilih Departemen --</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ $department->id == $selectedDepartment ? 'selected' : null }}>{{ $department->department_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="department-horizontal">Jenis Operator</label>
    </div>
    <div class="col-md-8 form-group">  
        <select wire:model="selectedOperatorType" name="operator_type_id" class="form-select @error('operator_type_id') is-invalid @enderror" id="basicSelect">
            <option value="" hidden>-- Pilih Jenis Operator --</option>
            @foreach($operatorTypes as $operatorType)
                <option value="{{ $operatorType->id }}" {{ $operatorType->id == $selectedOperatorType ? 'selected' : null }}>{{ $operatorType->operator_name_type }}</option>
            @endforeach
        </select>
    </div>
</div>
