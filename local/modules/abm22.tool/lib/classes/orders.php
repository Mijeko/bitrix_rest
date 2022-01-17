<?php

namespace Abm22\Tool\Classes;


use Bitrix\Main\Diag\Debug;
use Bitrix\Sale\Order;

class Orders
{
    public static function getListByUserId(int $user_id)
    {
        if (!\CModule::IncludeModule('sale')) return false;

        $orders = Order::getList([
            'filter' => [
                'USER_ID' => $user_id,
            ]
        ])->fetchAll();


        return $orders;
    }

    public static function getOne(int $order_id)
    {
        if (!\CModule::IncludeModule('sale')) return false;

        return Order::load($order_id);
    }
}