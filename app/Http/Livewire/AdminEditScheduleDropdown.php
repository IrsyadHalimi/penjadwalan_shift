<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\OperatorType;
use App\Models\User;
use App\Models\Shift;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;


class AdminEditScheduleDropdown extends Component
{
    public $scheduleId;
    public $selectedDepartment;
    public $selectedOperatorType;
    public $selectedOperator;
    public $selectedShift;

    public function mount($scheduleId)
    {
        $this->scheduleId = $scheduleId;
        $schedule = Schedule::findOrFail($scheduleId);
        $user = User::where('id', $schedule->user_id)->first();

        $this->selectedDepartment = $user->department_id;
        $this->selectedOperatorType = $user->operator_type_id;;
        $this->selectedOperator = $schedule->user_id;
        $this->selectedShift = $schedule->shift_id;
    }

    public function updatedSelectedDepartment($value)
    {
        $this->selectedOperatorType = null;
        $this->selectedShift = null;
    }
    
    public function updatedSelectedOperatorType($value)
    {
        $this->selectedOperator = null;
    }

    public function render()
    {
        $companyId = Auth::user()->company_id;
        $departments = Department::where('company_id', $companyId)->get();
        $operatorTypes = OperatorType::where('department_id', $this->selectedDepartment)->get();
        $operators = User::where('operator_type_id', $this->selectedOperatorType)->get();
        $shifts = Shift::where('department_id', $this->selectedDepartment)->get();

        return view('livewire.admin-edit-schedule-dropdown', [
            'departments' => $departments,
            'operatorTypes' => $operatorTypes,
            'operators' => $operators,
            'shifts' => $shifts,
        ]);
    }
}
