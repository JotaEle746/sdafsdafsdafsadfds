<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
/* class UsersExport implements FromCollection */
class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /* public function collection()
    {
        return User::all();
    } */
    protected $use;
    protected $persona;
    function __construct($users, $person) {
            $this->use = $users;
            $this->persona= $person;
    }
    public function view(): View
    {
        return view('admin.export',[
            'use' => $this->use, 'person' => $this->persona
        ]);

    }
    /* public function collection()
    {
        return User::all();
    } */
}
