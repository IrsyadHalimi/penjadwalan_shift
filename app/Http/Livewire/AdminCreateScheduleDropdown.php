<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\OperatorType;
use App\Models\User;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

class AdminCreateScheduleDropdown extends Component
{
    public $selectedDepartment;
    public $selectedOperatorType;
    public $selectedOperator;
    public $selectedShift;

    public function render()
    {
        $companyId = Auth::user()->company_id;
        $departments = Department::where('company_id', $companyId)->get();
        $operatorTypes = OperatorType::where('department_id', $this->selectedDepartment)->get();
        $shifts = Shift::where('department_id', $this->selectedDepartment)->get();
        $operators = User::where('operator_type_id', $this->selectedOperatorType)->get();

        return view('livewire.admin-create-schedule-dropdown', [
            'departments' => $departments,
            'operatorTypes' => $operatorTypes,
            'shifts' => $shifts,
            'operators' => $operators,
        ]);
    }
}
