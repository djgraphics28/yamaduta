<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class HomeFeaturedProducts extends Component
{
    public function render()
    {
        return view('livewire.home-featured-products',[
            'records' => $this->records
        ]);
    }

    public function getRecordsProperty()
    {
        return Product::with('category')
            ->where('is_active', true)
            ->where('is_visible', true)
            ->where('is_featured', true)->get();
    }
}
