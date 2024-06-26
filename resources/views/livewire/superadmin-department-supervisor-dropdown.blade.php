<div class="row">
    <div class="col-md-4">
        <label for="company-horizontal">Perusahaan</label>
    </div>
    <div class="col-md-8 form-group">  
        <select wire:model="selectedCompany" name="company_id" class="form-select" id="basicSelect">
            <option value="" hidden>-- Pilih Perusahaan --</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ $company->id == $selectedCompany ? 'selected' : null }}>{{ $company->company_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="department-horizontal">Departemen</label>
    </div>
    <div class="col-md-8 form-group">  
        <select wire:model="selectedDepartment" name="department_id" class="form-select" id="basicSelect">
            <option value="" hidden>-- Pilih Departemen --</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ $department->id == $selectedDepartment ? 'selected' : null }}>{{ $department->department_name }}</option>
            @endforeach
        </select>
    </div>
</div>
