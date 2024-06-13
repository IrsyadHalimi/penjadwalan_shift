<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\OperatorType;
use Illuminate\Support\Facades\Auth;


class AdminDepartmentOperatorDropdown extends Component
{
    public $selectedDepartment;
    public $selectedOperator;

    public function render()
    {
        $companyId = Auth::user()->company_id;
        $departments = Department::where('company_id', $companyId)->get();
        $operators = OperatorType::where('department_id', $this->selectedDepartment)->get();

        return view('livewire.admin-department-operator-dropdown', [
            'departments' => $departments,
            'operators' => $operators,
        ]);
    }
}
