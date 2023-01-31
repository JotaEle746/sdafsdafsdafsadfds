<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class CreateUsers extends Component
{
    public $register;
    public $crear=false;
    public $users;
    public $name, $email, $password;
    protected $rules=[
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'password' => 'required',
    ];

    public function mount(){
        $this->users=new User();
    }

    public function render()
    {
        return view('livewire.admin.create-users');
    }

    public function save(){
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ])->assignRole('admin');
        $this->register=$this->password;
    }
}
