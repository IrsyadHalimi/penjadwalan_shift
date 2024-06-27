<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shift;


class SuperadminShiftSearch extends Component
{
    use WithPagination;
    
    public $searchTerm;

    protected $queryString = ['searchTerm'];

    public function render()
    {
        $shifts = Shift::where(function($query) {
            $query->where('id', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('shift_name', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('department_id', 'like', '%'.$this->searchTerm.'%');
        })->paginate(10);

        return view('livewire.superadmin-shift-search', [
            'shifts' => $shifts,
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}
