<? //    debug($item)?>
<div id="container">

	<div id="content">
                    <ul class="circle-step">
                        <li class="col4">
                            <div class="sprite-circle circle-purple" >
                                <a class="sprite-big-btn big-btn-printer" href="#printer_description" title="Кратко о <?=$item['Brand']['name']?> <?=$item[$modelName]['name']?>"></a>
                            </div>
                            <a href="#printer_description" title="Характеристики <?=$item[$modelName]['name']?>">Описание принтера</a>
                        </li>
                        <li class="col4">
                            <div class="sprite-circle circle-blue" >
                                <a class="sprite-big-btn big-btn-forms" href="#how_flash_printer" title="Инструкция прошивки принтера <?=$item['Brand']['name']?> <?=$item[$modelName]['name']?>"></a>
                            </div>
                            <a href="#how_flash_printer" title="Как прошить <?=$item['Brand']['name']?> <?=$item[$modelName]['name']?>">Как прошить принтер</a>
                        </li>
                        <li  class="col4">
                            <div class="sprite-circle circle-yellow"  >
                                <a class="sprite-big-btn big-btn-card" href="#vk_comments" title="Отзывы по принтеру <?=$item['Brand']['name']?> <?=$item[$modelName]['name']?>"></a>
                            </div>
                            <a href="#vk_comments" title="Отзывы по <?=$item['Brand']['name']?> <?=$item[$modelName]['name']?>">Отзывы клиентов</a>
                        </li>
                        <li class="col4">
                            <div class="sprite-circle circle-green"  >
                                <a class="sprite-big-btn big-btn-email" href="/orders/order_fix/<?=$item[$modelName]['id']?>/<?=$item[$modelName]['slug']?>" title="Купить прошивки <?=$item[$modelName]['name']?>"></a>
                            </div>
                            <a href="/orders/order_fix/<?=$item[$modelName]['id']?>/<?=$item[$modelName]['slug']?>" title="Купить прошивку для принтера <?=$item[$modelName]['name']?>">Заказать прошивку</a>
                        </li>

                    </ul>
                    <div class="clr"></div>

                    <article class="printer-article">
						<section class="printer-header relative" itemscope itemtype="http://schema.org/ImageObject">
							<h1 class="printer-title printer-titleMain" itemprop="name">Прошивка для принтера : <?=$item['Brand']['name']?> <?=$item[$modelName]['name']?></h1>
							<div class="printer-photo" >
								<a  class="printer-photo-img fancybox" href="/files/images/<?=$controllerName?>/image/original/<?=$item[$modelName]['image']?>">
									<img itemprop="contentUrl" src="/files/images/<?=$controllerName?>/image/preview/<?=$item[$modelName]['image']?>" alt="Прошивка принтера <?=$item[$modelName]['name']?>"/>
								</a>
								<a id="printer-photo-img" href="/files/images/<?=$controllerName?>/image/original/<?=$item[$modelName]['image']?>"
                                   title="<?=$item[$modelName]['name']?>" class="printer-photo-scale">
                                    <span class="sprite-icons loupe"></span>
								</a>
							</div>
							<ul class="printer-descr" itemprop="description">
								<li>
									<p class="printer-descr-title">Модель</p>
									<p class="printer-descr-value"><?=$item[$modelName]['name']?></p>
								</li>
								<li>
									<p class="printer-descr-title">Картридж</p>
									<p class="printer-descr-value"><?=$item[$modelName]['cartridge']?></p>
								</li>
								<li>
									<p class="printer-descr-title">Ресурс картриджа</p>
									<p class="printer-descr-value"><?=$item[$modelName]['life_cartridge']?> стр.</p>
								</li>
								<li>
									<p class="printer-descr-title">Ресурс фотобарабана</p>
									<p class="printer-descr-value">~ <?=$item[$modelName]['life_photobaraban']?> заправки</p>
								</li>
								<li>
									<p class="printer-descr-title">Инструкция прошивки</p>
									<p class="printer-descr-value"><a href="#">Как прошить <?=$item['Brand']['name']?> <?=$item[$modelName]['name']?>?</a></p>
								</li>
							</ul>
							<section class="printer-order ">
								<a class="printer-order-btn" href="/orders/order_fix/<?=$item[$modelName]['price_fix']?>" title="<?=$item[$modelName]['name']?>"><span class="sprite-icons trademark lft"></span>Заказать</a>
								<p class="printer-order-price">Прошивка всего лишь <span class="printer-order-value"><?=$item[$modelName]['price_fix']?> грн.</span></p>
							</section>
							<div class="clr"></div>
							<section class="printer-relIconsBlock">
								<ul class="relIcons-List">
                                    <? if(!empty($item[$modelName]['image_report'])) {?>
									<li class="relIcons-Item">
										<a href="/files/images/<?=$controllerName?>/image_report/original/<?=$item[$modelName]['image_report']?>" 
                                           class="relIcons-link relIcons-ReportIco fancybox" 
                                           title="Отчет принтера <?=$item[$modelName]['name']?>, CRUM номер <?=$item[$modelName]['name']?>, серийный номер">
                                        </a>
									</li>
                                    <?}?>
                                    <? if(!empty($item[$modelName]['pdf_fix'])) {?>
									<li class="relIcons-Item">
										<a href="<?=$item[$modelName]['pdf_fix']?>" class="relIcons-link relIcons-PdfIco" title="PDF инструкция прошивки принтера <?=$item[$modelName]['name']?>"></a>
									</li>
                                    <?}?>
                                    <? if(!empty($item[$modelName]['pdf_refill'])) {?>
									<li class="relIcons-Item">
										<a href="<?=$item[$modelName]['pdf_refill']?>" class="relIcons-link relIcons-RefillIco" title="PDF инструкция заправки принтера <?=$item[$modelName]['name']?>"></a>
									</li>
                                    <?}?>                                    
                                    <? if(!empty($item['PrinterVideo'])) {?>                                    
									<li class="relIcons-Item">
										<a href="#" class="relIcons-link relIcons-YoutubeIco" title="Полезное видео по принтеру <?=$item[$modelName]['name']?>"></a>
									</li>
                                    <?}?>
                                    <? if(!empty($item['PrinterImage'])) {?>                                    
									<li class="relIcons-Item">
										<a href="#" 
                                           class="relIcons-link relIcons-PhotoIco " title="Фото <?=$item[$modelName]['name']?>">
                                        </a>
									</li>
                                    <?}?>
								</ul>
								<div class="clear"></div>
							</section>
						</section>

                        <a name="printer_description"></a>
                        <?if(!empty($item[$modelName]['full_description'])) {?>
                            <section class="printer-body printer-header relative">
                                <h1 class="printer-title">Описание принтера <?=$item['Brand']['name']?> <?=$item[$modelName]['name']?></h1>
                                <div>
                                    <?=$item[$modelName]['full_description']?>
                                </div>
                                <div class="clear"></div>
                            </section>
                        <?}?>

                        <a name="how_flash_printer"></a>
                            <?if(!empty($item[$modelName]['full_description'])) {?>
                            <section class="printer-body printer-header relative">
                                <h1 class="printer-title">Как прошить принтер <?=$item['Brand']['name']?> <?=$item[$modelName]['name']?></h1>
                                <div>
                                    <?=$item[$modelName]['fix_description']?>
                                </div>
                                <div class="clear"></div>
                            </section>
                        <?}?>


                        <a name="vk_comments"></a>
						<section class="printer-comments relative">
						   <div id="vk_comments"></div>
                            <script type="text/javascript">
                                VK.Widgets.Comments("vk_comments", {limit: 10, width: "1000", attach: false});
                            </script>
                        </section>
					</article>
					<div class="clear"></div>

				</div><!-- #content-->
</div><!-- #container-->