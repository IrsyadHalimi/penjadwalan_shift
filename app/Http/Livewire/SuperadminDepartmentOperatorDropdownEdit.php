<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Department;
use App\Models\OperatorType;
use App\Models\User;


class SuperadminDepartmentOperatorDropdownEdit extends Component
{
    public $userId;
    public $selectedCompany;
    public $selectedDepartment;
    public $selectedOperatorType;

    public function mount($userId)
    {
        $this->userId = $userId;
        $user = User::findOrFail($userId);

        $this->selectedCompany = $user->company_id;
        $this->selectedDepartment = $user->department_id;
        $this->selectedOperatorType = $user->operator_type_id;
    }

    public function updatedSelectedDepartment($value)
    {
        $this->selectedOperatorType = null;
    }

    public function render()
    {
        $companies = Company::where('id', $this->selectedCompany)->first();
        $departments = Department::where('company_id', $this->selectedCompany)->get();
        $operatorTypes = OperatorType::where('department_id', $this->selectedDepartment)->get();

        return view('livewire.superadmin-department-operator-dropdown-edit', [
            'companies' => $companies,
            'departments' => $departments,
            'operatorTypes' => $operatorTypes,
        ]);
    }
}
