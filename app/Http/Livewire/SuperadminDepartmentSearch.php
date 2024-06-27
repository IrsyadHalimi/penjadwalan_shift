<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Department;


class SuperadminDepartmentSearch extends Component
{
    use WithPagination;
    
    public $searchTerm;

    protected $queryString = ['searchTerm'];

    public function render()
    {
        $departments = Department::where(function($query) {
            $query->where('id', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('department_name', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('company_id', 'like', '%'.$this->searchTerm.'%');
        })->paginate(10);

        return view('livewire.superadmin-department-search', [
            'departments' => $departments,
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}
