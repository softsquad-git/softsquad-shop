<?php

namespace App\Models\Orders;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'total_price',
        'products_ids',
        'post_code',
        'city',
        'address',
        'email',
        'phone',
        'additional_information',
        'quantity',
        'shipment_id',
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
