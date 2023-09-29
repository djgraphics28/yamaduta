<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Color;
use App\Models\Rating;
use App\Models\Category;
use App\Models\ChildProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 'product_code', 'sku', 'main_image', 'category_id', 'name', 'price', 'total_stock', 'description', 'is_active', 'is_visible', 'is_featured' ];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get all of the child_products for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function child_products(): HasMany
    {
        return $this->hasMany(ChildProduct::class, 'product_id', 'id');
    }

    /**
     * Get all of the ratings for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'product_id', 'id');
    }
}
