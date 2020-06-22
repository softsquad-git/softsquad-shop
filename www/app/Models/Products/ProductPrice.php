<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $table = 'products_price';

    protected $fillable = [
        'product_id',
        'not_not_applicable',
        'price',
        'old_price',
        'start_promotion',
        'end_promotion'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
