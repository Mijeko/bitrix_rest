<?php

namespace Abm22\Tool\Rest\Models;

use Abm22\Tool\Rest\RestApiInterface;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Basket as SaleBasket;
use Bitrix\Main\Context;
use Bitrix\Sale\BasketItem;
use Bitrix\Main\Application;
use Bitrix\Currency\CurrencyManager;

class Basket implements RestApiInterface
{
    public function actionIndex()
    {
        // TODO: Implement actionIndex() method.
    }

    public function actionCreate($params)
    {
        if (!\CModule::IncludeModule('sale')) throw new \Exception(Loc::getMessage('ABM22_TOOL_MODULE_SALE_NOT_INSTALLED'));

        $site_id = Context::getCurrent()->getSite();
        $basket = SaleBasket::loadItemsForFUser(Fuser::getId(), $site_id);
        if (!array_key_exists('product_id', $params)) throw new \Exception(Loc::getMessage('ABM22_TOOL_BASKET_API_PARAM_NOT_SENDED'));
        $product_id = strval($params['product_id']);

        if ($item = $basket->getExistsItem('catalog', $product_id)) {
            $item->setField('QUANTITY', $item->getQuantity() + 1);
        } else {
            $item = $basket->createItem('catalog', $product_id);
            $result = $item->setFields(array(
                'QUANTITY' => 1,
                'CURRENCY' => CurrencyManager::getBaseCurrency(),
                'LID' => $site_id,
                'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
            ));

            $basket->addItem($item);
        }


        $result = $basket->save();
        if (!$result->isSuccess()) {

            $response_error = [];
            foreach ($result->getErrors() as $error) {
                $response_error[] = $error->getMessage();
            }


            throw new \Exception($response_error);
        }

        return [
            'status' => $basket->getExistsItem('catalog', $product_id) instanceof BasketItem ? 200 : 500
        ];
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
        // TODO: Implement actionView() method.
    }
}