<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Trainer;

class TrainerTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'asc';

   
    public $confirmingDelete = false; // Add this
    public $trainerToDelete ;


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    public function edit($trainerID)
    {
        return redirect()->route('trainers.edit', $trainerId);
    }

    public function confirmDelete($trainerId)
    {
        $this->confirmingDelete = true;
        $this->trainerToDelete = $trainerId;
    }

    public function deleteTrainer()
    {  
        Trainer::find($this->trainerToDelete)->delete();
        $this->confirmingDelete = false;
        session()->flash('success', 'Trainers deleted successfully');
        return redirect()->route('trainers.index'); 
    }


    public function render()
    {
       return view('livewire.trainer-table', [
            'trainers' => Trainer::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                          ->orWhere('specialty', '=', '%'.$this->search.'%');
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]); 
    }
}
