<?php

namespace App\Models;

use App\Models\ChildProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' ];

    /**
     * Get all of the child_products for the Size
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function child_products(): HasMany
    {
        return $this->hasMany(ChildProduct::class, 'size_id', 'id');
    }
}
