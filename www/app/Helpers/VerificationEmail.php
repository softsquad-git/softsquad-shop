<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class VerificationEmail
{
    public static function keyGenerate(int $length)
    {
        return substr(md5(Str::random(64)), $length, $length);
    }

    public static function findKeyDb()
    {
        //
    }

    public static function sendEmail(string $to)
    {
        //
    }

    public static function saveKey()
    {
        //
    }
}
