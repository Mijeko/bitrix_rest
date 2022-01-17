<?php

namespace Abm22\Tool\Orm;

use Bitrix\Main\Localization\Loc;

class Abm22ToolEquipmentPointsTable extends \Bitrix\Main\Entity\DataManager
{
    public static function getTableName()
    {
        return 'abm22_tool_equipment_points';
    }

    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('POINT_ENTITY_ID_FIELD'),
            ),
            'PRODUCT_ID' => array(
                'data_type' => 'string',
                'title' => Loc::getMessage('POINT_ENTITY_PRODUCT_ID_FIELD'),
            ),
            'POS_X' => array(
                'data_type' => 'string',
                'title' => Loc::getMessage('POINT_ENTITY_POS_X_FIELD'),
            ),
            'POS_Y' => array(
                'data_type' => 'string',
                'title' => Loc::getMessage('POINT_ENTITY_POS_Y_FIELD'),
            ),
            'SORT' => array(
                'data_type' => 'string',
                'title' => Loc::getMessage('POINT_ENTITY_SORT_FIELD'),
            ),
        );
    }
}