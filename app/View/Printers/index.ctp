<div id="container">
	<div id="content">
		<h1 class="hpage txt_green">прайс прошивок для принтера 
<!--            <a href="#" class="download_green">Скачать</a>-->
        </h1>
		<section class="models-filter">
            <div class="models-filterWrap">
				<input id="search_input" class="models-filter-value filter" placeholder="начните вводить свою модель" 
                       data-placeholder="начните вводить свою модель" name="livefilter" type="text" style="width: 270px" value="" />
            </div>     
		</section>
		<?if(!empty($data)) {?>
		<section class="table">
			<div class="table-row-title">
				<div class="lft col4">Брэнд</div>
				<div class="lft col4">Модель (модель, версия)</div>
				<div class="lft col4">Цена</div>
				<div class="lft col4">Заказать</div>
				<div class="clr"></div>
			</div>
			<ul id="search_list" class="live_filter">
				<? foreach($data as $printer) { ?>
				   <li class="table-row">
					   <div class="lft col4">
						   <a href="/brands/brand/<?=$printer['Brand']['id']?>/<?=$printer['Brand']['slug']?>" title="Информация про компанию <?=$printer['Brand']['name']?>">
							   <?=$printer['Brand']['name']?>
						   </a>
					   </div>
					   <div class="lft col4">
						   <a href="/<?=$controllerName?>/view/<?=$printer[$modelName]['id']?>/<?=$printer[$modelName]['slug']?>" title="Прошивка для принтера <?=$printer['Brand']['name']?> <?=$printer[$modelName]['name']?>">
							   <?=$printer[$modelName]['name']?>
						   </a>
					   </div>
					   <div class="lft col4 center">
						   <a href="/orders/order_fix/<?=$controllerName?>/view/<?=$printer[$modelName]['id']?>/<?=$printer[$modelName]['slug']?>"
                              title="Цена прошивки <?=$printer[$modelName]['name']?>">
                                <?=$printer[$modelName]['price_fix']?>
                           </a>
					   </div>
					   <div class="lft col4 center">
						   <a href="/orders/order_fix/<?=$printer[$modelName]['id']?>/<?=$printer[$modelName]['slug']?>" class="btn_order_model"
                              title="Купить прошивку <?=$printer[$modelName]['name']?>">
						   </a>
					   </div>
					   <div class="clr"></div>
				   </li>
				<? }?>
			</ul>
		</section>
		<?} else {?>
			<section>Нет данных, зайдите пожалуйста позже.</section>
		<?}?>
	</div><!-- #content-->
</div><!-- #container-->