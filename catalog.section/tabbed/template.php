<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$admin=($USER->GetID()==1)?true:false;

$this->setFrameMode(true);
?>
<?php if(!empty($arResult['ITEMS'])):?>

<?php if($arResult['DESCRIPTION']!==''):?>
	<div class="section_descr"><?=$arResult['DESCRIPTION']?></div>
<?php endif;?>

<?php if(!strripos($arResult['CODE'],'licenses') && (!is_null($arResult["SECTION_NEWS"]) || !is_null($arResult["SECTION_ARTICLES"]) || !is_null($arResult["SECTION_INTRODUCTION"]))):?>
<?php echo '</div>';//center_block?>
<div class="tabs_container">
	<div class="hr"></div>
	<div class="tabs-nav">
		<a class="tabs-target" href="#product"><?=GetMessage('SECTION_PRODUCT');?></a>
		<?php if($arResult['SECTION_NEWS']):?>
			<a class="tabs-target" href="#news"><?=GetMessage('SECTION_NEWS');?></a>
		<?php endif;?>
		<?php if($arResult['SECTION_ARTICLES']):?>
			<a class="tabs-target" href="#articles"><?=GetMessage('SECTION_ARTICLES');?></a>
		<?php endif;?>
		<?php if($arResult['SECTION_INTRODUCTION']):?>
			<a class="tabs-target" href="#introduction"><?=GetMessage('SECTION_INTRODUCTION');?></a>
		<?php endif;?>
		<div class="hr"></div>
	</div>
	<div class="hr"></div>
</div>
<?php echo '<div class="center_block">';?>
<?php endif;?>

<div class="tabs-items">
	<div class="products_container" data-id="product">
		<?php foreach($arResult['ITEMS'] as $item):?>
			<div class="item" <?=strripos($arResult['CODE'],'licenses')?'id="'.$item['CODE'].'"':''?>>
				<div class="name_container">
					<a href="<?=$item['DETAIL_PAGE_URL']?>">
						<span class="name"><?=$item['NAME']?></span>
					</a>
				</div>

				<?php if($item['MIN_PRICE']['DISCOUNT_DIFF']==0):?>
		            <div class="price"><?=$item['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></div>
		        <?php else:?>
		            <div class="discount">
		                <div class="old_price"><?=$item['MIN_PRICE']['PRINT_VALUE_NOVAT']?></div>
		                <div class="price"><?=$item['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></div>
		            </div>
		        <?php endif;?>

				<a class="order"
				   href="javascript:void(0);"
				   onclick="getdemo(this);"
				   data-name="<?=$item['NAME']?>"
				>
					<?php if(!strripos($arResult['CODE'],'licenses')):?>
						<?=GetMessage('ORDER_DEMO')?>
					<?php else:?>
						<?=GetMessage('ORDER')?>
					<?php endif;?>
				</a>
			</div>
		<?php endforeach;?>
	</div>

	<?php if (!empty($arResult['SECTION_NEWS'])):?>
        <div class="items_container" data-id="news">
            <?php foreach ($arResult['SECTION_NEWS'] as $news):?>
                <div class="item">
                    <div class="date"><?=stristr($news["ACTIVE_FROM"], " ", true);?></div>
                    <a href="<?=$news['DETAIL_PAGE_URL']?>"><?=$news['NAME']?></a>
                    <div class="preview "><?=$news["PREVIEW_TEXT"]?></div>
                </div>
            <?php endforeach;?>
        </div>
    <?php endif;?>

    <?php if (!empty($arResult['SECTION_ARTICLES'])):?>
        <div class="items_container" data-id="articles">
            <?php foreach ($arResult['SECTION_ARTICLES'] as $news):?>
                <div class="item">
                    <div class="date"><?=stristr($news['ACTIVE_FROM'], " ", true);?></div>
                    <a href="<?=$news['DETAIL_PAGE_URL']?>"><?=$news['NAME']?></a>
                    <div class="preview "><?=$news["PREVIEW_TEXT"]?></div>
                </div>
            <?php endforeach;?>
        </div>
    <?php endif;?>

    <?php if (!empty($arResult['SECTION_INTRODUCTION'])):?>
        <div class="items_container" data-id="introduction">
            <?php foreach ($arResult['SECTION_INTRODUCTION'] as $news):?>
                <div class="item">
                    <div class="date"><?=stristr($news['ACTIVE_FROM'], " ", true);?></div>
                    <a href="<?=$news['DETAIL_PAGE_URL']?>"><?=$news['NAME']?></a>
                    <div class="preview "><?=$news["PREVIEW_TEXT"]?></div>
                </div>
            <?php endforeach;?>
        </div>
    <?php endif;?>
</div>

<script>
    $(function() {
        var href = document.location.hash.substr(1,document.location.hash.length);
        var tab = $('.tabs-items > div');

        tab.hide().filter(':first').show();
        // Клики по вкладкам.
        $('.tabs-nav a').click(function(){
            tab.hide();
            tab.filter('[data-id="'+this.hash.substring(1)+'"]').show();
            $('.tabs-nav a').removeClass('active');
            $(this).addClass('active');
            return true;
        }).filter(':first').click();

        if (href!='') {
            $('.tabs-nav a').filter('a[href="#'+href+'"]').click();
        }
    });
</script>

<?php endif;?>
