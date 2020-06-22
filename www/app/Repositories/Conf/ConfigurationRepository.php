<?php

namespace App\Repositories;

use App\Models\Conf\Configuration;

class ConfigurationRepository
{
    protected function check() {
        return Configuration::all();
    }
}
