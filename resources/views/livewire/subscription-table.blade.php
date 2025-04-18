<div>
     <!-- Success Message -->
     @if(session('success'))
     <div class="alert success">
         {{ session('success') }}
     </div>
     @endif
    
    <!-- Table -->
    <div class="">
        <div class="top-bar">
            <h1>Subscriptions</h1>
            <img src="https://i.pravatar.cc/40" alt="User" class="avatar">
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <a href="{{route('subscriptions.create')}}" class="btn">+ Add Subscription</a>
        </div>
        <!-- Search Box -->
        <div class="mb-4">
            <input 
                type="text" 
                wire:model.debounce.300ms="search" 
                placeholder="Search subscription..."
                class="border rounded px-4 py-2 w-full md:w-1/3"
            >
        </div>
        <table >
            <thead >
                <tr>
                    <th wire:click="sortBy('id')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        ID
                        @if($sortField === 'id')
                            @if($sortDirection === 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th wire:click="sortBy('name')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                       Memeber 
                        @if($sortField === 'name')
                            @if($sortDirection === 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th wire:click="sortBy('email')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        type
                        @if($sortField === 'email')
                            @if($sortDirection === 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        price
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        from
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        to
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody >
                @foreach($subscriptions as $subscription)
                    <tr>
                        <td >
                            {{ $subscription->id }}
                        </td>
                        <td >
                            <div class="text-sm font-medium ">{{ $subscription->member->name }}</div>
                        </td>
                        <td >
                            {{ $subscription->type }}
                        </td>
                        <td >
                            {{ $subscription->price }} $
                        </td>
                        <td >
                            {{ $subscription->start_date }}
                        </td>
                        <td >
                            {{ $subscription->end_date }}
                        </td>
                        <td >
                            {{ $subscription->status }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="actions">
                                <a wire:click="edit({{ $subscription->id }})" class="btn edit">Edit</a>
                                <a  wire:click="confirmDelete({{ $subscription->id }})" class="btn delete">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($confirmingDelete)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center   px-4 pb-20 text-center sm:block sm:p-0" style="height:400px; padding-top: 11rem;" >
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 ">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            Delete Member
                        </h3>
                        <p class="text-sm text-gray-500">
                            Are you sure you want to delete this member? This action cannot be undone.
                        </p>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="deleteMember" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                        <button wire:click="$set('confirmingDelete', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
   
    <!-- Pagination -->
    <div class="mt-4">
        {{ $subscriptions->links() }}
    </div>
</div>

<!-- Add this at the bottom of member-table.blade.php -->



