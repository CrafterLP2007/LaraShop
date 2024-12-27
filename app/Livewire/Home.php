<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('theme::home')->layout('theme::components.layouts.app');
    }
}
