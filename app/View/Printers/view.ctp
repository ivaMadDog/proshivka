<? //    debug($item)?>
<div id="container">

	<div id="content">
					<h1 class="hpage txt_green">прайс прошивок для принтера <a href="#" class="download_green">Скачать</a></h1>

					<article class="printer-article">
						<section class="printer-header">
							<h1 class="printer-title">Прошивка для принтера : <?=$item[$modelName]['name']?></h1>
							<div class="printer-photo">
								<a  class="printer-photo-img fancybox" href="/files/images/<?=$controllerName?>/image/original/<?=$item[$modelName]['image']?>">
									<img src="/files/images/<?=$controllerName?>/image/preview/<?=$item[$modelName]['image']?>" alt="Прошивка принтера Samsung CLP-320"/>
								</a>
								<a id="printer-photo-img" href="/files/images/<?=$controllerName?>/image/original/<?=$item[$modelName]['image']?>"
                                   title="<?=$item[$modelName]['name']?>" class="printer-photo-scale">
                                    <span class="sprite-icons loupe"></span></a>
							</div>
							<ul class="printer-descr">
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
									<p class="printer-descr-value"><?=$item[$modelName]['life_cartridge']?></p>
								</li>
								<li>
									<p class="printer-descr-title">Ресурс фотобарабана</p>
									<p class="printer-descr-value">~ <?=$item[$modelName]['life_photobaraban']?> заправки</p>
								</li>
								<li>
									<p class="printer-descr-title">Инструкция прошивки</p>
									<p class="printer-descr-value"><a href="#">Как прошить Samsung CLP-320?</a></p>
								</li>
							</ul>
							<section class="printer-order">
								<a class="printer-order-btn" href="/orders/order_fix/<?=$item[$modelName]['price_fix']?>" title="<?=$item[$modelName]['name']?>"><span class="sprite-icons trademark lft"></span>Заказать</a>
								<p class="printer-order-price">Прошивка всего лишь <span class="printer-order-value"><?=$item[$modelName]['price_fix']?> грн.</span></p>
							</section>
							<div class="clr"></div>
						</section>
						<div class="clear"></div>
						<section class="printer-body">
							<h1 class="printer-title">Описание принтера <?=$item['Brand']['name']?> <?=$item[$modelName]['name']?></h1>
							<div>
								<?=$item[$modelName]['full_description']?>
							</div>
							<div>
								<?=$item[$modelName]['fix_description']?>
							</div>
						</section>
						<div class="clear"></div>

						<section class="printer-comments">
							<div id="vk_comments"></div>
						   <!-- <script type="text/javascript">VK.Widgets.Comments("vk_comments", {limit: 20, width: "1000", attach: false});</script> -->
						</section>
					</article>
					<div class="clear"></div>

				</div><!-- #content-->
</div><!-- #container-->