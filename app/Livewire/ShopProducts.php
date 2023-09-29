<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopProducts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.shop-products',[
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
