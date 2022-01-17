<?php

namespace Abm22\Tool\Classes;

class Product
{
//    const CURRENCY = '&#8381;';
//    const CURRENCY = "<img src='" . SITE_TEMPLATE_PATH . "/images/r.svg' style='height:14px; margin-top:-4px;'>";
    const CURRENCY = '₽';
    const CURRENCY_DOLLAR = '$';

    public static function formatPrice(string $price, bool $useCurrency, $default_currency = false)
    {
        $price = self::clearPrice($price);

        $price = number_format($price, 2, ',', ' ');
        $price = str_replace([',00', '.00'], '', $price);

        if ($useCurrency) {
            if (!$default_currency) {
                $price .= ' ' . self::CURRENCY;
            } else {
                $price .= ' ' . $default_currency;
            }
        }
        return $price;
    }

    public static function formatPrePrice(string $price, bool $useCurrency, $default_currency = false)
    {
        $price = self::clearPrice($price);

        $price = number_format($price, 2, ',', ' ');
        $price = str_replace([',00', '.00'], '', $price);

        if ($useCurrency) {
            if (!$default_currency) {
                $price = self::CURRENCY . $price;
            } else {
                $price = $default_currency . $price;
            }
        }
        return $price;
    }

    protected function clearPrice(string $price)
    {
        $price = str_replace([' ', ','], ['', '.'], $price);
        return $price;
    }

    public static function showPrice(
        $arItem = array(),
        $arParams = array(),
        $bOrderViewBasket = false,
        $bWideBlock = false,
        $bShowSchema = true
    )
    {

        ?>
        <? if (strlen($arItem['PROPERTIES']['FILTER_PRICE']['VALUE'])): ?>
        <div class="price<?= ($bOrderViewBasket ? '  inline' : '') ?>">
            <div class="price_new">
                    <span class="price_val" <? if ($bShowSchema): ?>itemprop="price" content="<?= $arItem['PROPERTIES']['FILTER_PRICE']['VALUE'] ?>"<? endif; ?>>
                        <?= self::formatPrice($arItem['PROPERTIES']['FILTER_PRICE']['VALUE'], true) ?>
                    </span>
            </div>
            <? if ($arItem['PROPERTIES']['PRICEOLD']['VALUE']): ?>
                <div class="price_old">
                    <? if ($bWideBlock): ?>
                        <?= GetMessage('PRICE_DISCOUNT') ?>
                    <? endif; ?>
                    <span class="price_val"><?= self::formatPrice($arItem['PROPERTIES']['PRICEOLD']['VALUE'], true) ?></span>
                </div>
            <? endif; ?>
        </div>
    <? endif; ?>
        <?
    }

    public static function showPriceDollar(
        $arItem = array(),
        $arParams = array(),
        $bOrderViewBasket = false,
        $bWideBlock = false,
        $bShowSchema = true
    )
    {

        ?>
        <? if (strlen($arItem['PROPERTIES']['PRICE_DOLLAR']['VALUE'])): ?>
        <div class="price<?= ($bOrderViewBasket ? '  inline' : '') ?>">
            <div class="price_new">
                    <span class="price_val" <? if ($bShowSchema): ?>itemprop="price" content="<?= $arItem['PROPERTIES']['PRICE_DOLLAR']['VALUE'] ?>"<? endif; ?>>
                        <?= self::formatPrePrice($arItem['PROPERTIES']['PRICE_DOLLAR']['VALUE'], true, self::CURRENCY_DOLLAR) ?>
                    </span>
            </div>
            <? if ($arItem['PROPERTIES']['PRICEOLD']['VALUE']): ?>
                <div class="price_old">
                    <? if ($bWideBlock): ?>
                        <?= GetMessage('PRICE_DISCOUNT') ?>
                    <? endif; ?>
                    <span class="price_val"><?= self::formatPrePrice($arItem['PROPERTIES']['PRICEOLD']['VALUE'], true) ?></span>
                </div>
            <? endif; ?>
        </div>
    <? endif; ?>
        <?
    }

}
