<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserKontak extends Component
{

    public function render()
    {
        return view('livewire.user-kontak')->extends('layouts.user')->section('content');
    }
}
