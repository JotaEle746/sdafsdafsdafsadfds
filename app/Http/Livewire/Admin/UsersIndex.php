<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
class UsersIndex extends Component
{
    public $search;
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $users=User::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->paginate(5);
        return view('livewire.admin.users-index', compact('users'));
    }
}
