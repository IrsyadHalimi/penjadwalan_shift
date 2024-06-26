<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Department;

class SuperadminDepartmentSupervisorDropdown extends Component
{
    public $selectedCompany;
    public $selectedDepartment;

    public function render()
    {
        $companies = Company::all();
        $departments = Department::where('company_id', $this->selectedCompany)->get();

        return view('livewire.superadmin-department-supervisor-dropdown', [
            'companies' => $companies,
            'departments' => $departments,
        ]);
    }
}
