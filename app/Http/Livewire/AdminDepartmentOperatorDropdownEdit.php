<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\OperatorType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminDepartmentOperatorDropdownEdit extends Component
{
    public $userId;
    public $selectedDepartment;
    public $selectedOperatorType;

    public function mount($userId)
    {
        $this->userId = $userId;
        $user = User::findOrFail($userId);

        $this->selectedDepartment = $user->department_id;
        $this->selectedOperatorType = $user->operator_type_id;
    }

    public function updatedSelectedDepartment($value)
    {
        $this->selectedOperatorType = null;
    }

    public function render()
    {
        $companyId = Auth::user()->company_id;
        $departments = Department::where('company_id', $companyId)->get();
        $operatorTypes = OperatorType::where('department_id', $this->selectedDepartment)->get();

        return view('livewire.admin-department-operator-dropdown-edit', [
            'departments' => $departments,
            'operatorTypes' => $operatorTypes,
        ]);
    }
}
