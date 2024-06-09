<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\OperatorType;

class DepartmentOperatorDropdown extends Component
{
    public $departments;
    public $operators;
    public $selectedDepartment;

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function updatedSelectedDepartment($value)
    {
        if (!empty($value)) {
            $this->operators = OperatorType::where('department_id', $value)->get();
        } else {
            $this->operators = [];
        }
    }

    public function render()
    {
        return view('livewire.department-operator-dropdown');
    }
}
