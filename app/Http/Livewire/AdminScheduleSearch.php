<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AdminScheduleSearch extends Component
{
    use WithPagination;
    
    public $searchTerm;

    protected $queryString = ['searchTerm'];

    public function render()
    {
        $companyId = Auth::user()->company_id;
        $userId = User::where('company_id', $companyId)->where('role', 'operator')->pluck('id')->toArray();

        $schedules = Schedule::where(function($query) use ($userId) {
            $query->whereIn('user_id', $userId);
        })->where(function($query) {
            $query->where('id', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('user_id', 'like', '%'.$this->searchTerm.'%');
        })->paginate(10);

        return view('livewire.admin-schedule-search', [
            'schedules' => $schedules,
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}
