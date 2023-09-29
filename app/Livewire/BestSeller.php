<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class BestSeller extends Component
{
    public function render()
    {
        return view('livewire.best-seller',[
            'records' => $this->records
        ]);
    }

    public function getRecordsProperty()
    {
        return Product::with('category')
            ->where('is_active', true)
            ->where('is_visible', true)->paginate(9);
    }
}
