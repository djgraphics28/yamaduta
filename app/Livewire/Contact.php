<?php

namespace App\Livewire;

use App\Models\Contact as Cont;
use Livewire\Component;

class Contact extends Component
{
    public $location = '';
    public $contact_number = '';
    public $email = '';

    public function mount()
    {
        $data = Cont::find(1)->first();

        $this->location = $data->location;
        $this->contact_number = $data->contact_number;
        $this->email = $data->email;
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
