<?php

namespace Abm22\Tool\Classes;


use Bitrix\Main\Diag\Debug;

class ContactFaces
{
    const IBLOCK_ID = 40;

    public static function getListForUser(int $user_id)
    {
        if (!\CModule::IncludeModule('iblock')) return false;
        $response = array();
        $result = \CIBlockElement::GetList([], ['IBLOCK_ID' => self::IBLOCK_ID, 'PROPERTY_USER_ID' => $user_id], false, false,
            array('ID', 'NAME', 'PROPERTY_EMAIL', 'PROPERTY_USER', 'PROPERTY_PHONE')
        );

        while ($element = $result->GetNext()) {
            $response[] = [
                'ID' => $element['ID'],
                'NAME' => $element['NAME'],
                'EMAIL' => $element['PROPERTY_EMAIL_VALUE'],
                'USER' => $element['PROPERTY_USER_VALUE'],
                'PHONE' => $element['PROPERTY_PHONE_VALUE'],
            ];
        }

        return $response;
    }
}