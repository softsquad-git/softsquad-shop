<?php

namespace App\Models\Conf;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configuration';

    protected $fillable = [
        'g_admin_id',
        'page_name',
        'page_description',
        'logo',
        'contact_email',
        'contact_phone',
        'localization',
        'is_accept_new_user',
        'additional_info'
    ];
}
