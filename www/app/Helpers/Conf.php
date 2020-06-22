<?php

namespace App\Helpers;

use \App\Models\Conf\Configuration;
use \Exception;

class Conf
{
    /**
     * @return mixed
     * @throws Exception
     */
    public static function get()
    {
        $page = Configuration::first();
        if (empty($page))
            throw new Exception(trans('conf.G_ERROR'));
        return $page;
    }
}
