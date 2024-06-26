<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Department;
use App\Models\OperatorType;
use App\Models\User;
use App\Models\Shift;

class SuperadminCreateScheduleDropdown extends Component
{
    public $selectedCompany;
    public $selectedDepartment;
    public $selectedOperatorType;
    public $selectedOperator;
    public $selectedShift;

    public function mount()
    {
        $this->selectedCompany = old('company_id');
        $this->selectedDepartment = old('department_id');
        $this->selectedOperatorType = old('operator_type_id');
        $this->selectedOperator = old('user_id');
        $this->selectedShift = old('shift_id');
    }

    public function render()
    {
        $companies = Company::all();
        $departments = [];
        $operatorTypes = [];
        $shifts = [];
        $operators = [];

        if (!is_null($this->selectedCompany)) {
            $departments = Department::where('company_id', $this->selectedCompany)->get();
        }
        
        if (!is_null($this->selectedDepartment)) {
            $operatorTypes = OperatorType::where('department_id', $this->selectedDepartment)->get();
            $shifts = Shift::where('department_id', $this->selectedDepartment)->get();
        }

        if (!is_null($this->selectedOperatorType)) {
            $operators = User::where('operator_type_id', $this->selectedOperatorType)->get();
        }

        return view('livewire.superadmin-create-schedule-dropdown', [
            'companies' => $companies,
            'departments' => $departments,
            'operatorTypes' => $operatorTypes,
            'shifts' => $shifts,
            'operators' => $operators,
        ]);
    }
}
