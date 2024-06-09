<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\OperatorType;

class DepartmentOperatorDropdown extends Component
{
    public $selectedDepartment;
    public $selectedOperator;

    public function render()
    {
        // Dapatkan data departemen dan operator dari database atau sumber data lain
        $departments = Department::all();
        $operators = OperatorType::where('department_id', $this->selectedDepartment)->get();

        return view('livewire.department-operator-dropdown', [
            'departments' => $departments,
            'operators' => $operators,
        ]);
    }
}
