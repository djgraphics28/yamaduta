<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Color;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 'product_code', 'main_image', 'other_image', 'category_id', 'name', 'price', 'stocks', 'description', 'sizes', 'colors', 'is_active', 'is_visible', 'is_featured' ];

    protected $casts = [
        'sizes' => 'json',
        'colors' => 'json',
    ];
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
     * Get the color that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    /**
     * Get the size that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}
