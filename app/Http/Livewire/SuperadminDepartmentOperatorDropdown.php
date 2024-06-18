<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\OperatorType;

class SuperadminDepartmentOperatorDropdown extends Component
{
    public $selectedDepartment;
    public $selectedOperatorType;

    public function render()
    {
        $departments = Department::all();
        $operatorTypes = OperatorType::where('department_id', $this->selectedDepartment)->get();

        return view('livewire.admin-department-operator-dropdown', [
            'departments' => $departments,
            'operatorTypes' => $operatorTypes,
        ]);
    }
}
