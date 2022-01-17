<?php

namespace Abm22\Tool\Rest\Models;

use Abm22\Tool\Rest\RestApiInterface;
use Bitrix\Main\Localization\Loc;

class Equipment implements RestApiInterface
{
    public function actionIndex()
    {
        if (!\CModule::IncludeModule('iblock')) throw new \Exception(Loc::getMessage('ABM22_TOOL_MODULE_NOT_INSTALLED'));

        $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
        $product_id = intval($request->get('product_id'));
        $result = array();
        $filter = array();

        if ($product_id) $filter['PRODUCT_ID'] = $product_id;

        $query = \Abm22\Tool\Orm\Abm22ToolEquipmentPointsTable::getList([
            'filter' => $filter
        ])->fetchAll();

        foreach ($query as $point) {
            $result[] = $point;
        }

        return $result;
    }

    public function actionCreate($params)
    {
        // TODO: Implement actionCreate() method.
    }

    public function actionUpdate($id, $params)
    {
        // TODO: Implement actionUpdate() method.
    }

    public function actionDelete($id)
    {
        // TODO: Implement actionDelete() method.
    }

    public function actionView($id)
    {
    }
}