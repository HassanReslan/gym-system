<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subscription;

class SubscriptionTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'asc';

   
    public $confirmingDelete = false; // Add this
    public $subToDelete ;


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    public function edit($subscriptionId)
    {
        return redirect()->route('subscriptions.edit', $subscriptionId);
    }

    public function confirmDelete($subscriptionId)
    {
        $this->confirmingDelete = true;
        $this->subToDelete = $subscriptionId;
    }

    public function deleteMember()
    {
        
        Subscription::find($this->subToDelete)->delete();
        $this->confirmingDelete = false;
        session()->flash('success', 'Subscription deleted successfully');
    }


    public function render()
    {
       return view('livewire.subscription-table', [
            'subscriptions' => Subscription::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                          ->orWhere('status', '=', $this->search);
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]); 
    }
}