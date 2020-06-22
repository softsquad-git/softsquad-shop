<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'products_images';

    protected $fillable = [
        'product_id',
        'src'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
