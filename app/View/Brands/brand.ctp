<? // debug($printers)?>
<div id="container">
	<div id="content">
		<h1 class="hpage txt_green"><?=$item[$modelName]['name']?></h1>
		<?if(!empty($item)) {?>
            <section class="brands-list-container">
                    <section class="brands-list-item">
                        <div class="brands-list-item-wrap">
                            <div class="brands-list-item-body">
                                <h2 class="brands-list-item-body-logo ">
                                    <a href="/<?=$controllerName?>/view/<?=$item[$modelName]['id']?>/<?=$item[$modelName]['slug']?>" title="Принтеры <?=$item[$modelName]['name']?>">
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
            </section>
            <section class="brand-short-description">
                <div class="brand-short-description-date">
                    <div class="brand-short-description-label">Год основания</div>
                    <div class="brand-short-description-data"><?=$item[$modelName]['foundation']?></div>
                </div>
                <div class="brand-short-description-office">
                    <div class="brand-short-description-label">Офисы</div>
                    <div class="brand-short-description-data"><?=$item[$modelName]['offices']?></div>
                </div>
                <div class="brand-short-description-url">
                    <div class="brand-short-description-label">Сайт</div>
                    <div><?=$item[$modelName]['url']?></div>
                </div>
                <div class="brand-short-description-share">
                    <div class="brand-short-description-label">Социальные сети</div>
                    <div class="brand-short-description-data">
                        
                    </div>
                </div>
            </section>
            <div class="clear"></div>
            <article class="brand-short-description-article">
                <?=$item[$modelName]['full_description']?>
            </article>
            
            <?if(!empty($printers)) {?>
                <section class="brands-list-container">
                  <?foreach($printers as $item) { ?>  
                        <section class="brands-list-item">
                            <div class="brands-list-item-wrap">
                                <div class="brands-list-item-body">
                                    <h2 class="brands-list-item-body-logo ">
                                        <a href="/printers/view/<?=$item['Printer']['id']?>/<?=$item['Printer']['slug']?>" title="Принтеры <?=$item['Printer']['name']?>">
                                            <img src="/files/images/printers/image/preview/<?=$item['Printer']['image']?>"/>
                                        </a>
                                    </h2>
                                    <h3 class="brands-list-item-body-title">
                                        <a href="/printers/view/<?=$item['Printer']['id']?>" title="<?=$item['Printer']['name']?>">
                                            <?=$item['Printer']['name']?>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </section>
                    <?}?>
                </section>
            <?}?>
		<?} else {?>
			<section>Нет данных, зайдите пожалуйста позже.</section>
		<?}?>
	</div><!-- #content-->
</div><!-- #container-->