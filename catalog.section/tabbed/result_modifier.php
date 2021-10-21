<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

function getDataTab($ib, $filter) {
	$arOrder = [
	    "SORT"=>"ASC",
	    "ACTIVE_FROM"=>"DESC",
	];
	$arSelectFields = ['IBLOCK_ID', 'ID', 'NAME', 'PREVIEW_TEXT', 'DETAIL_PAGE_URL', 'TIMESTAMP_X_UNIX'];

	$arrData = CIBlockElement::GetList($arOrder, ['ACTIVE'=>'Y', 'IBLOCK_ID'=>$ib, 'PROPERTY_product.ID'=>$filter], false, false, $arSelectFields);

	while ($el = $arrData->GetNextElement()){
	    $element = $el->GetFields();
	    $result[] = $element;
	}
	return $result;
}

$arResult["SECTION_NEWS"] = getDataTab($arParams['SECTION_NEWS_IB'], $arResult['ELEMENTS']);
$arResult["SECTION_ARTICLES"] = getDataTab($arParams['SECTION_ARTICLES_IB'], $arResult['ELEMENTS']);
$arResult["SECTION_INTRODUCTION"] = getDataTab($arParams['SECTION_INTRODUCTION_IB'], $arResult['ELEMENTS']);