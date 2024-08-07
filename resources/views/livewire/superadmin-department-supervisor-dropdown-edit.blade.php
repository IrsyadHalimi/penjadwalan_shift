<div class="row">
    <div class="col-md-4">
        <label for="company-horizontal">Perusahaan</label>
    </div>
    <div class="col-md-8 form-group">
        <input type="text" name="company_id" value="{{ $companies->company_name }}" id="company-horizontal" class="form-control" readonly>
    </div>
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
</div>
