<footer id="footer">
    <section class="anons">
            <form class="anons-form" action="#">
                <div class="lft anons-label">Анонсы, статьи и бонусы от «Proshivka.biz»:</div>
                <div class="lft"><input class="anons-email" type="text" name="" value="" placeholder="ваш email..."/></div>
                <div class="lft"><input class="form-btn-blue" type="submit" name="" value="Подписаться"/></div>
            </form>
    </section>
    <section class="footer_menu">
        <section class="footer_menu-block">
            <h3><a href="#">О прошивке</a></h3>
            <ul>
                <li><a href="#">Что такое прошивка?</a></li>
                <li><a href="#">Как заполнить форму?</a></li>
                <li><a href="#">Как оплатить заказ?</a></li>
                <li><a href="#">Как получить прошивку?</a></li>
                <li><a href="#">Как прошить принтер?</a></li>
            </ul>
        </section>
        <section class="footer_menu-block">
            <h3><a href="#">Сотрудничество</a></h3>
            <ul>
                <li><a href="#">Как стать партнером?</a></li>
                <li><a href="#">Для партнеров?</a></li>
                <li><a href="#">Вакансии?</a></li>
            </ul>
        </section>
        <section class="footer_menu-block">
            <h3><a href="#">Полезное</a></h3>
            <ul>
                <li><a href="#">Новости от PROSHIVKA.BIZ</a></li>
                <li><a href="#">Бесплатные прошивки!</a></li>
                <li><a href="#">Все модели принтеров</a></li>
                <li><a href="#">Отзывы клиентов</a></li>
            </ul>
        </section>
        <section class="footer_menu-block">
            <h3><a href="#">Присоединяйтесь</a></h3>
            <ul class="mini-socials">
                <li><a class="sprites-social vk-mini-ico" href="#">Вконтакте</a></li>
                <li><a class="sprites-social fb-mini-ico" href="#">Facebook</a></li>
                <li><a class="sprites-social tw-mini-ico" href="#">Twitter</a></li>
                <li><a class="sprites-social yt-mini-ico" href="#">YouTube</a></li>
                <li><a class="sprites-social rss-mini-ico" href="#">RSS</a></li>
            </ul>
        </section>
        <div class="clr"></div>
    </section><!-- footer_menu  -->
    <div class="footer-money">
        <h4>Принимаем к оплате:</h4>
        <ul class="footer-money-list">
            <li><a class="sprites-money mc-money-ico" href="#"></a></li>
            <li><a class="sprites-money visa-money-ico" href="#"></a></li>
            <li><a class="sprites-money wb-money-ico" href="#"></a></li>
            <li><a class="sprites-money ym-money-ico" href="#"></a></li>
            <li><a class="sprites-money qw-money-ico" href="#"></a></li>
        </ul>
    </div>
     <div class="footer-stat-counter">

    </div>
    <div class="footer-copyright">
        <p>© «Proshivki.biz», 2013 <br />
        магазин прошивок для принтера<br />
        Украина, Россия</p>
        <a href=#"">Карта сайта</a>
    </div>
    <div class="footer-phones">
        <ul>
            <li><?=($contacts['Default']['Contact']['name'])?></li>
            <li>
				<?if(!empty($contacts['Others'][0]))?>
				<?=($contacts['Others'][0]['Contact']['name'])?>
			</li>
        </ul>
        <div><a href="/about_us">Все контакты</a></div>
    </div>

</footer><!-- #footer -->