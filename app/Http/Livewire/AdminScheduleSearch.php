<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Schedule;


class AdminScheduleSearch extends Component
{
    use WithPagination;
    
    public $searchTerm;

    protected $queryString = ['searchTerm'];

    public function render()
    {    
        $schedules = Schedule::where('id', 'like', '%'.$this->searchTerm.'%')
        ->orWhere('user_id', 'like', '%'.$this->searchTerm.'%')
        ->paginate(10);
    
        return view('livewire.admin-schedule-search', [
            'schedules' => $schedules,
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}
