<div id="container">
	<div id="content">
		<!--<h1 class="hpage txt_green">бренды принтеров</h1>-->
		<?if(!empty($data)) {?>
		<section class="brands-list-container">
          <?foreach($data as $item) { ?>  
                <section class="brands-list-item">
                    <div class="brands-list-item-wrap">
                        <div class="brands-list-item-body">
                            <h2 class="brands-list-item-body-logo ">
                                <a href="/<?=$controllerName?>/brand/<?=$item[$modelName]['id']?>/<?=$item[$modelName]['slug']?>" title="Принтеры <?=$item[$modelName]['name']?>">
                                    <img src="/files/images/<?=$controllerName?>/image/preview/<?=$item[$modelName]['image']?>"/>
                                </a>
                            </h2>
<!--                            <h3 class="brands-list-item-body-title">
                                <a href="/<?=$controllerName?>/view/<?=$item[$modelName]['id']?>" title="<?=$item[$modelName]['name']?>">
                                    <?=$item[$modelName]['name']?>
                                </a>
                            </h3>-->
                        </div>
                    </div>
                </section>
            <?}?>
		</section>
		<?} else {?>
			<section>Нет данных, зайдите пожалуйста позже.</section>
		<?}?>
	</div><!-- #content-->
</div><!-- #container-->