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
									<p class="printer-descr-title">�?нструкция прошивки</p>
									<p class="printer-descr-value"><a href="#">Как прошить Samsung CLP-320?</a></p>
								</li>
							</ul>
							<section class="printer-order">
								<a class="printer-order-btn" href="#" title=""><span class="sprite-icons trademark lft"></span>Заказать</a>
								<p class="printer-order-price">Прошивка всего лишь <span class="printer-order-value"><?=$item[$modelName]['price_fix']?> грн.</span></p>
							</section>
							<div class="clr"></div>
						</section>

						<section class="printer-body">
							<h1 class="printer-title">Описание принтера Samsung CLP-320</h1>
							<div>
								<p>Лазерный принтер Samsung CLP-320 с удобной для пользователя системой управления выполнит работу быстро и без проблем.
								Одним нажатием кнопки вы можете распечатать содержимое экрана монитора. Помимо прекрасной скорости принтер Samsung
								CLP-320 демонстрирует высокое качество цветной печати с разрешением до 2400 x 600 тчк/дюйм. Эта модель отличается
								лаконичным дизайном, ее стильный корпус выполнен в черных и кремово-серых тонах. Отличная производительность и
								элегантный внешний вид делают принтер CLP-320 желанным гостем любого офиса или дома.</p>
								<p>C экрана на бумагу. Одним нажатием кнопки
								Кнопка Print Screen, удобно расположенная на панели управления CLP-320, позволяет легко и быстро распечатать изображение
								с экрана монитора, даже если в данный момент вы находитесь далеко от своего компьютера. Технология предельно проста: всего
								одно нажатие кнопки! Вам не понадобится редактировать документы или удалять ненужное содержимое с веб-страниц. Если стоит
								задача распечатать всего одну страницу, более удобной функции не найти! Одно нажатие кнопки — и на печать будет выведено
								все, что вы можете видеть на экране своего монитора. А если удерживать кнопку более двух секунд, принтер распечатает только
								содержимое активного окна. Просто как никогда!</p>
							</div>
						</section>

						<section class="printer-comments">
							<div id="vk_comments"></div>
						   <!-- <script type="text/javascript">VK.Widgets.Comments("vk_comments", {limit: 20, width: "1000", attach: false});</script> -->
						</section>
					</article>

					<section class="reason5 bg_blue">
						<section>
							<h2 class="reason5-h"><span class="white-line"></span>5 причин прошиться у нас<span class="white-line"></span></h2>
							<ul>
								<li class="reason5-block">
									<a class="btn_blue btn_blue-pig" href="#"></a>
									<h3 class="reason5-block-title"><a href="">Экономия денег</a></h3>
									<p class="reason5-block-text">Экономьте на прошивке принтера и заменах картриджей.</p>
								</li>
								<li class="reason5-block">
									<a  class="btn_blue btn_blue-time" href="#"></a>
									<h3 class="reason5-block-title"><a href="">Экономия времени</a></h3>
									<p class="reason5-block-text">Всего за 15 минут Вы можете заказать и прошить принтер.</p>
								</li>
								<li class="reason5-block">
									<a  class="btn_blue btn_blue-quality" href="#"></a>
									<h3 class="reason5-block-title"><a href="">Гарантия качества</a></h3>
									<p class="reason5-block-text">Качественные фиксы, отзывы клиентов, репутация.</p>
								</li>
								<li class="reason5-block">
									<a  class="btn_blue btn_blue-ref"  href="#"></a>
									<h3 class="reason5-block-title"><a href="">Реферальная программа</a></h3>
									<p class="reason5-block-text">Приглашайте друзей и получайте бонусы на личный счет.</p>
								</li>
								<li class="reason5-block">
									<a  class="btn_blue btn_blue-support"  href="#"></a>
									<h3 class="reason5-block-title"><a href="">�?нтернет поддержка</a></h3>
									<p class="reason5-block-text">Обратная связь, чат, skype, соцсети, инструкции.</p>
								</li>
							</ul>
						</section>
						<div class="clr"></div>
						<section class="garanty">
							<h2 class="garanty-h"><span class="white-line"></span>Наши гарантии на прошивку<span class="white-line"></span></h2>
							<section class="garanty-col">
								<div class="garanty-logo"></div>
								<div class="garanty-text">
									Мы уверены в качестве наших прошивок для
									принтеров, поэтому, заказав их у нас - Вы
									экономите деньги на картриджах!
								</div>
							</section>
							<section class="garanty-col">

							</section>
							<div class="clr"></div>
						</section>
					</section>


				</div><!-- #content-->
</div><!-- #container-->