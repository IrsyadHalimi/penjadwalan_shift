<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;


class SuperadminCompanySearch extends Component
{
    use WithPagination;
    
    public $searchTerm;

    protected $queryString = ['searchTerm'];

    public function render()
    {
        $companies = Company::where(function($query) {
            $query->where('id', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('company_name', 'like', '%'.$this->searchTerm.'%');
        })
        ->orderBy('company_name')
        ->paginate(10);

        return view('livewire.superadmin-company-search', [
            'companies' => $companies,
        ]);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}
