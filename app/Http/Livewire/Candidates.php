<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Candidate;
use Livewire\WithPagination;

class Candidates extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm='';
    public $pageSize =10;

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatedPageSize()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Candidate::when($this->searchTerm, function($q){
            $q->where('name', 'like', '%'.$this->searchTerm.'%')
              ->orWhere('surname', 'like', '%'.$this->searchTerm.'%')
              ->orWhere('email', 'like', '%'.$this->searchTerm.'%')
              ->orWhere('mobile', 'like', '%'.$this->searchTerm.'%')
              ->orWhere('sa_id', 'like', '%'.$this->searchTerm.'%')
              ->orWhere('language', 'like', '%'.$this->searchTerm.'%')
              ->orWhere('interests', 'like', '%'.$this->searchTerm.'%');

        })->paginate($this->pageSize);
        return view('livewire.candidates', compact('data'));
    }
}
