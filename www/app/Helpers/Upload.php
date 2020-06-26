<?php

namespace App\Helpers;

use App\Models\Products\ProductImage;
use Illuminate\Support\Str;
use \Exception;

class Upload
{
    /**
     * @param array $images
     * @param int $resourceId
     * @param string $src
     * @throws Exception
     */
    public static function multiFile(array $images, int $resourceId, string $src)
    {
        try {
            foreach ($images as $image) {
                $fileName = md5(time() . Str::random(32)) . '.' . $image->getClientOriginalExtension();
                $image->move($src, $fileName);
                self::saveFileToDb($fileName, $resourceId);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param string $fileName
     * @param int $resourceId
     * @return mixed
     */
    private static function saveFileToDb(string $fileName, int $resourceId)
    {
        return ProductImage::create([
            'product_id' => $resourceId,
            'src' => $fileName
        ]);
    }
}
