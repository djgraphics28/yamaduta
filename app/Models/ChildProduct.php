<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildProduct extends Model
{
    use HasFactory;

    protected $fillable = [ 'product_id', 'name', 'parent_sku', 'child_sku', 'size', 'color', 'stocks', 'price', 'image' ];

    // /**
    //  * Get the size that owns the ChildProduct
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function size(): BelongsTo
    // {
    //     return $this->belongsTo(Size::class, 'size_id', 'id');
    // }

    // /**
    //  * Get the color that owns the ChildProduct
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function color(): BelongsTo
    // {
    //     return $this->belongsTo(Color::class, 'color_id', 'id');
    // }

    /**
     * Get the product that owns the ChildProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
