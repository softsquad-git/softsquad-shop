<?php

namespace App\Helpers;

class Status
{
    #users
    public const SS_USER_ADMIN = 1;
    public const SS_USER_USER = 2;
    public const SS_USER_WAITING_ACCEPT = 3;
    #products
    public const SS_PRODUCT_ACTIVE = 1;
    public const SS_PRODUCT_ARCHIVE = 2;
    public const SS_PRODUCT_INACCESSIBLE = 3;
}
