<?php

namespace App\Helpers;

class Image
{
    private static $DF_AVATAR = 'df.png';
    private static $DF_PRODUCT = 'df.png';

    public static function topProduct(?object $image)
    {
        if (empty($image->src))
            return asset(Path::SS_PRODUCT_IMAGES . self::$DF_PRODUCT);
        return asset(Path::SS_PRODUCT_IMAGES . $image->src);
    }
}
