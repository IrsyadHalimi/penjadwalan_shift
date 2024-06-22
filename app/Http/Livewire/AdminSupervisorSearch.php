<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AdminSupervisorSearch extends Component
{
    use WithPagination;
    
    public $searchTerm;

    protected $queryString = ['searchTerm'];

    public function render()
    {
        $companyId = Auth::user()->company_id;
        $userId = User::where('company_id', $companyId)->where('role', 'supervisor')->pluck('id')->toArray();

        $supervisors = User::where(function($query) use ($userId) {
            $query->whereIn('id', $userId);
        })->where(function($query) {
            $query->where('id', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('full_name', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('department_id', 'like', '%'.$this->searchTerm.'%');
        })->paginate(10);

        return view('livewire.admin-supervisor-search', [
            'supervisors' => $supervisors,
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}
