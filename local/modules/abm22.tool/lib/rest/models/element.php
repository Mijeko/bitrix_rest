<?php


namespace Abm22\Tool\Rest\Models;

use Abm22\Tool\Rest\RestApiInterface;
use Bitrix\Main\Localization\Loc;

class Element implements RestApiInterface
{

    public function actionIndex()
    {
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
        \CModule::IncludeModule('catalog');

        $iblock_element = \CIBlockElement::GetList(array(), array('IBLOCK_ID' => IBLOCK_CATALOG, 'ID' => $id), false, false, ['ID', 'NAME', 'PROPERTY_ARTICLE'])->Fetch();
        if (!$iblock_element) throw new \Exception(Loc::getMessage('ABM22_TOOL_REST_API_ELEMENT_NOT_FOUND'));

        $response_data = [
            'ID' => $iblock_element['ID'],
            'NAME' => $iblock_element['NAME'],
            'ARTICLE' => $iblock_element['PROPERTY_ARTICLE_VALUE'],
        ];

        if ($catalog_element = \CCatalogProduct::GetByID($id)) {
            $response_data['CATALOG_ELEMENT'] = $catalog_element;
        }


        return array(
            $response_data
        );
    }
}