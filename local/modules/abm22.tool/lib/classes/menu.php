<?php

namespace Abm22\Tool\Classes;

use CCache;
use CAllcorp2;

class Menu
{
	public static function getMenuItems($arMenuParametrs, &$aMenuLinks)
	{
		$aMenuLinksExt = array();

		if ($arMenuParametrs) {
			if ($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y') {
				$arSections = CCache::CIBlockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]['aspro_allcorp2_catalog']['aspro_allcorp2_catalog'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]['aspro_allcorp2_catalog']['aspro_allcorp2_catalog'][0], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'SECTION_ID' => $arMenuParametrs['SECTION_ID']));
				$arSectionsByParentSectionID = CCache::GroupArrayBy($arSections, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
			}

			if ($arMenuParametrs['MENU_SHOW_ELEMENTS'] == 'Y') {
				$arItems = CCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]['aspro_allcorp2_catalog']['aspro_allcorp2_catalog'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]['aspro_allcorp2_catalog']['aspro_allcorp2_catalog'][0], 'ACTIVE' => 'Y', 'SECTION_GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'INCLUDE_SUBSECTIONS' => 'Y'));
				if ($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y') {
					$arItemsBySectionID = CCache::GroupArrayBy($arItems, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
				} else {
					$arItemsRoot = CCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]['aspro_allcorp2_catalog']['aspro_allcorp2_catalog'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]['aspro_allcorp2_catalog']['aspro_allcorp2_catalog'][0], 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'SECTION_ID' => 0));
					$arItems = array_merge((array)$arItems, (array)$arItemsRoot);
				}
			}

			if ($arSections) {
				CAllcorp2::getSectionChilds($arMenuParametrs['SECTION_ID'], $arSections, $arSectionsByParentSectionID, $arItemsBySectionID, $aMenuLinksExt);
			}

			if ($arItems && $arMenuParametrs['MENU_SHOW_SECTIONS'] !== 'Y') {
				foreach ($arItems as $arItem) {
					$aMenuLinksExt[] = array($arItem['NAME'], $arItem['DETAIL_PAGE_URL'], array(), array('FROM_IBLOCK' => 1, 'DEPTH_LEVEL' => 1));
				}
			}
		}


		$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
	}
}