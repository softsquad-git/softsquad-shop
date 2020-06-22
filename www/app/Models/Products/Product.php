<?php

namespace App\Models\Products;

use App\Models\Categories\Category;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'description',
        'min_description',
        'start_public_date',
        'end_public_date',
        'status',
        'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function price()
    {
        return $this->hasOne(ProductPrice::class, 'product_id');
    }
}
