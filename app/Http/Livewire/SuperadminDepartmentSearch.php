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
        $userId = User::where('role', 'operator')->pluck('id')->toArray();

        $operators = User::where(function($query) use ($userId) {
            $query->whereIn('id', $userId);
        })->where(function($query) {
            $query->where('id', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('full_name', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('department_id', 'like', '%'.$this->searchTerm.'%');
        })->paginate(10);

        return view('livewire.superadmin-department-search', [
            'operators' => $operators,
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}