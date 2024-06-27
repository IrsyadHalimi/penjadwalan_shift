<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Department;

class SuperadminCompanyDepartmentDropdown extends Component
{
    public $selectedCompany;
    public $selectedDepartment;

    public function mount()
    {
        $this->selectedCompany = old('company_id');
        $this->selectedDepartment = old('department_id');
    }

    public function render()
    {
        $companies = Company::all();
        $departments = [];

        if (!is_null($this->selectedCompany)) {
            $departments = Department::where('company_id', $this->selectedCompany)->get();
        }

        return view('livewire.superadmin-company-department-dropdown', [
            'companies' => $companies,
            'departments' => $departments,
        ]);
    }
}
