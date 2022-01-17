<?php

namespace Abm22\Tool\Classes;

use CAllcorp2;

class Compare
{
	const COMPARE_KEY = 'CATALOG_COMPARE_LIST';
	const IBLOCK_ID = 35;

	public static function showButtonCompare($element_id)
	{
		$label = "<i class='fas fa-balance-scale'></i> Сравнить";
		$classList = ['add-to-compare', 'jsToggleCompare'];

		if (self::isAdded($element_id)) {
			$classList[] = 'active';
			$label = "<i class='fas fa-balance-scale'></i> Удалить из сравнения";
		}

		return "<a data-prod-id='{$element_id}' class='" . implode(' ', $classList) . "' href='" . SITE_TEMPLATE_PATH . "/ajax/addToCompare.php'>{$label}</a>";
	}

	public static function showButtonCompareFloat()
	{
		$count = count($_SESSION[Compare::COMPARE_KEY][Compare::IBLOCK_ID]['ITEMS']);
		return "<div class='inner-table-block small-block nopadding compare-float' data-type_search='fixed'>
<div class='compare-float__counter " . ($count > 0 ? 'active' : '') . "'><span>" . $count . "</span></div>
					<a href='/compare/'  title=''>" . CAllcorp2::showIconSvg('search big', SITE_TEMPLATE_PATH . '/images/svg/compare.svg') . "</a>
				</div>";
	}

	public static function isAdded($element_id)
	{
		return array_key_exists($element_id, $_SESSION[self::COMPARE_KEY][self::IBLOCK_ID]['ITEMS']);
	}
}