<div class="row">
<div class="col-md-4">
    <label for="company-horizontal">Company</label>
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
        <option value="" hidden>-- Pilih Departemen --</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->getDepartmentName() }}</option>
        @endforeach
    </select>
</div>
</div>
