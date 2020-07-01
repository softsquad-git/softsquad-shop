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
    #orders
    public const SS_ORDER_ACCEPTED_FOR_IMPLEMENTATION = 1;
    public const SS_ORDER_READY_TO_PICK_UP = 2;
    public const SS_ORDER_READY_TO_SHIPMENT = 3;
    public const SS_ORDER_PENDING_PAYMENT = 4;
    public const SS_ORDER_PAID = 5;
    public const SS_ORDER_COMPLETED = 6;
}
