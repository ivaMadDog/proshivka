<? //    debug($data)?>
<div id="container">

	<div id="content">
		<h1 class="hpage txt_green">прайс прошивок для принтера <a href="#" class="download_green">Скачать</a></h1>
		<section class="models-filter">
				<input id="input_filter" class="models-filter-value filter" name="livefilter" type="text" style="width: 250px" value="" />
		</section>
		<?if(!empty($data)) {?>
		<section class="table">
			<div class="table-row-title">
				<div class="lft col2">Модель (производитель, модель, версия)</div>
				<div class="lft col4">Цена необновляемой прошивки</div>
				<div class="lft col4">Заказать</div>
				<div class="clr"></div>
			</div>
			<ul class="live_filter">
				<? foreach($data as $ptinter) { ?>
				   <li class="table-row">
					   <div class="lft col2">
						   <a href="/<?=$controllerName?>/view/<?=$ptinter[$modelName]['id']?>/<?=$ptinter[$modelName]['slug']?>">
							   <?=$ptinter[$modelName]['name']?>
						   </a>
					   </div>
					   <div class="lft col4 center">
						   <a href="/orders/create/<?=$controllerName?>/view/<?=$ptinter[$modelName]['id']?>/<?=$ptinter[$modelName]['slug']?>"><?=$ptinter[$modelName]['price_fix']?></a>
					   </div>
					   <div class="lft col4 center">
						   <a href="/orders/create/<?=$controllerName?>/view/<?=$ptinter[$modelName]['id']?>/<?=$ptinter[$modelName]['slug']?>" class="btn_order_model">
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