<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\OperatorType;


class SelectDropdowns extends Component
{
    public $departments;
    public $operatorTypes;
    public $selectedDepartment;

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function updatedSelectedDepartment($departmentId)
    {
        if (!empty($departmentId)) {
            $this->operatorTypes = OperatorType::where('department_id', $departmentId)->get();
        } else {
            $this->operatorTypes = [];
        }
    }

    public function render()
    {
        return view('livewire.select-dropdowns');
    }
}
