<?php

namespace App\Models\Enums;

use Illuminate\Contracts\Support\DeferringDisplayableValue;
use Illuminate\Support\Str;

enum Ability: string implements DeferringDisplayableValue
{
    case MANAGE_SHOP            = 'manage-shop';
    case MANAGE_ORDER           = 'manage-order';
    case MANAGE_CUSTOMER        = 'manage-customer';
    case MANAGE_ADMIN           = 'manage-admin';
    case MANAGE_SITE_SETTINGS   = 'manage-site-settings';
    case MANAGE_SHOP_LOCATION   = 'manage-shop-location';
    case MANAGE_STOCK           = 'manage-stock';
    case MANAGE_REPORT          = 'manage-report';
    case POINT_OF_SALE          = 'point-of-sale';

    public function resolveDisplayableValue(): string
    {
        return Str::headline($this->value);
    }

    public function description(): string
    {
        return match ($this) {
            self::MANAGE_ADMIN          => 'Can create and manage admin accounts and roles',
            self::MANAGE_SHOP           => 'Can create, view, update and delete products, categories, brands and colors',
            self::MANAGE_CUSTOMER       => 'Can create, view, update and delete customer accounts',
            self::MANAGE_ORDER          => 'Can view and manage customer orders',
            self::MANAGE_REPORT         => 'Can view and download sales reports',
            self::MANAGE_STOCK          => 'Can add or remove stock quantity across locations',
            self::MANAGE_SHOP_LOCATION  => 'Can create, view, update and delete locations',
            self::MANAGE_SITE_SETTINGS  => 'Can update and manage site information',
            self::POINT_OF_SALE         => 'Can sell products from point of sale (POS)',
        };
    }
}
