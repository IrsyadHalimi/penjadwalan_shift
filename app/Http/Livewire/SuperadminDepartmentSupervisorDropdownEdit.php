<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Department;
use App\Models\User;

class SuperadminDepartmentSupervisorDropdownEdit extends Component
{
    public $userId;
    public $selectedCompany;
    public $selectedDepartment;

    public function mount($userId)
    {
        $this->userId = $userId;
        $user = User::findOrFail($userId);

        $this->selectedCompany = $user->company_id;
        $this->selectedDepartment = $user->department_id;
    }

    public function updatedSelectedCompany($value)
    {
        $this->selectedDepartment = null;
    }

    public function render()
    {
        $companies = Company::where('id', $this->selectedCompany)->first();
        $departments = Department::where('company_id', $this->selectedCompany)->get();

        return view('livewire.superadmin-department-supervisor-dropdown-edit', [
            'companies' => $companies,
            'departments' => $departments,
        ]);
    }
}
