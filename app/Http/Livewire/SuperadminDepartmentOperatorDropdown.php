<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Department;
use App\Models\OperatorType;

class SuperadminDepartmentOperatorDropdown extends Component
{
    public $selectedCompany;
    public $selectedDepartment;
    public $selectedOperatorType;

    public function render()
    {
        $companies = Company::all();
        $departments = Department::where('company_id', $this->selectedCompany)->get();
        $operatorTypes = OperatorType::where('department_id', $this->selectedDepartment)->get();

        return view('livewire.superadmin-department-operator-dropdown', [
            'companies' => $companies,
            'departments' => $departments,
            'operatorTypes' => $operatorTypes,
        ]);
    }
}
