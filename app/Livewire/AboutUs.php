<?php

namespace App\Livewire;

use App\Models\About;
use Livewire\Component;

class AboutUs extends Component
{
    public $company_history = '';
    public $founder_message = '';
    public $mission_statement = '';
    public $community_involvement = '';
    public $social_media_links = '';

    public function mount()
    {
        $data = About::find(1)->first();

        $this->company_history = $data->company_history;
        $this->founder_message = $data->founder_message;
        $this->mission_statement = $data->mission_statement;
        $this->community_involvement = $data->community_involvement;
        $this->social_media_links = $data->social_media_links;
    }

    public function render()
    {
        return view('livewire.about-us');
    }
}
