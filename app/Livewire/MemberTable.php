<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Member; // Your model

class MemberTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'asc';

   
    public $confirmingDelete = false; // Add this
    public $memberToDelete ;


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    public function edit($memberId)
    {
       
        return redirect()->route('members.edit', $memberId);
    }

    public function confirmDelete($memberId)
    {
        $this->confirmingDelete = true;
        $this->memberToDelete = $memberId;
    }

    public function deleteMember()
    {
        
        Member::find($this->memberToDelete)->delete();
        $this->confirmingDelete = false;
        session()->flash('success', 'Member deleted successfully');
    }


    public function render()
    {
       return view('livewire.member-table', [
            'members' => Member::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                          ->orWhere('email', 'like', '%'.$this->search.'%');
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]); 
    }
}