<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class FeaturedProducts extends Component
{
    public function render()
    {
        return view('livewire.featured-products',[
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
