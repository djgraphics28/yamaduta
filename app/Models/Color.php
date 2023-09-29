<?php

namespace App\Models;

use App\Models\ChildProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'color_code'];

    /**
     * Get all of the child_products for the Color
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function child_products(): HasMany
    {
        return $this->hasMany(ChildProduct::class, 'color_id', 'id');
    }
}
