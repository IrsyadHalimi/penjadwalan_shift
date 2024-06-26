<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Schedule;
use App\Models\User;


class SuperadminScheduleSearch extends Component
{
    use WithPagination;
    
    public $searchTerm;

    protected $queryString = ['searchTerm'];

    public function render()
    {
        $schedules = Schedule::where(function($query) {
            $query->where('id', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('user_id', 'like', '%'.$this->searchTerm.'%');
        })->paginate(10);

        return view('livewire.superadmin-schedule-search', [
            'schedules' => $schedules,
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}
