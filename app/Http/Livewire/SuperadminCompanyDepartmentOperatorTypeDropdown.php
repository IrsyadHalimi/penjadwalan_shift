<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Department;
use App\Models\OperatorType;


class SuperadminCompanyDepartmentOperatorTypeDropdown extends Component
{
    public $selectedCompany;
    public $selectedDepartment;
    public $selectedOperatorType;

    public function mount()
    {
        $this->selectedCompany = old('company_id');
        $this->selectedDepartment = old('department_id');
        $this->selectedOperatorType = old('operator_type_id');
    }

    public function render()
    {
        $companies = Company::all();
        $departments = [];
        $operator_types = [];

        if (!is_null($this->selectedCompany)) {
            $departments = Department::where('company_id', $this->selectedCompany)->get();
        }
        
        if (!is_null($this->selectedDepartment)) {
            $operator_types = OperatorType::where('department_id', $this->selectedDepartment)->get();
        }

        return view('livewire.superadmin-company-department-operator-type-dropdown', [
            'companies' => $companies,
            'departments' => $departments,
            'operator_types' => $operator_types,
        ]);
    }
}
