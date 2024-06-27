<div class="row">
<div class="col-md-4">
    <label for="company-horizontal">Perusahaan</label>
</div>
<div class="col-md-8 form-group">  
    <select wire:model="selectedCompany" name="company_id" class="form-select @error('company_id') is-invalid @enderror" id="basicSelect">
        <option value="" hidden>-- Pilih Perusahaan --</option>
        @foreach($companies as $company)
            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->getCompanyName() }}</option>
        @endforeach
    </select>
</div>
<div class="col-md-4">
    <label for="department-horizontal">Departemen</label>
</div>
<div class="col-md-8 form-group">  
    <select wire:model="selectedDepartment" name="department_id" class="form-select @error('department_id') is-invalid @enderror" id="basicSelect">
        <option value="" hidden>-- Pilih Departen --</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->getDepartmentName() }}</option>
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
            <option value="{{ $operatorType->id }}" {{ old('operator_type_id') == $operatorType->id ? 'selected' : '' }}>{{ $operatorType->operator_name_type }}</option>
        @endforeach
    </select>
</div>
<div class="col-md-4">
    <label for="department-horizontal">Operator</label>
</div>
<div class="col-md-8 form-group">  
    <select wire:model="selectedOperator" name="user_id" class="form-select @error('user_id') is-invalid @enderror" id="basicSelect">
        <option value="" hidden>-- Pilih Operator --</option>
        @foreach($operators as $operator)
            <option value="{{ $operator->id }}" {{ old('user_id') == $operator->id ? 'selected' : '' }}>{{ $operator->full_name }}</option>
        @endforeach
    </select>
</div>
<div class="col-md-4">
    <label for="department-horizontal">Shift</label>
</div>
<div class="col-md-8 form-group">  
    <select wire:model="selectedShift" name="shift_id" class="form-select @error('shift_id') is-invalid @enderror" id="basicSelect">
        <option value="" hidden>-- Pilih Shift --</option>
        @foreach($shifts as $shift)
            <option value="{{ $shift->id }}" {{ old('shift_id') == $shift->id ? 'selected' : '' }}>{{ $shift->shift_name }}</option>
        @endforeach
    </select>
</div>
</div>
