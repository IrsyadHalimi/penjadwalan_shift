<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OperatorType;


class SuperadminOperatorTypeSearch extends Component
{
    use WithPagination;
    
    public $searchTerm;

    protected $queryString = ['searchTerm'];

    public function render()
    {
        $operatorTypes = OperatorType::where(function($query) {
            $query->where('id', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('operator_name_type', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('department_id', 'like', '%'.$this->searchTerm.'%');
        })
        ->orderBy('operator_name_type')
        ->paginate(10);

        return view('livewire.superadmin-operator-type-search', [
            'operator_types' => $operatorTypes,
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}
