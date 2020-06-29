<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipments';

    protected $fillable = [
        'name',
        'price',
        'additional_information'
    ];
}
