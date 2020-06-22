<?php

namespace App\Models\Users;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SpecificData extends Model
{
    protected $table = 'specific_data_user';

    protected $fillable = [
        'user_id',
        'name',
        'last_name',
        'nick',
        'location',
        'sex',
        'number_phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
