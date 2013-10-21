<footer id="footer">
    <section class="anons">
			<?= $this->form->create('Subscribe', array('url'=>'/subscribes/subscribe', "id"=>"SubscribeForm", 'class'=>'anons-form'));?>
                <div class="lft anons-label">Анонсы, статьи и бонусы от «Proshivki.biz»:</div>
                <div class="lft">
					<?= $this->form->input('email', array('type'=>'text', 'class'=>'anons-email','placeholder'=>"ваш email...", 'data-placeholder'=>"ваш email...", 'label'=>false, 'div'=>false));?>
				</div>
                <div class="lft">
					<?= $this->form->submit("Подписаться", array('class'=>'form-btn-blue','label'=>false, 'div'=>false));?>
				</div>
			<?=$this->form->end();?>
    </section>
    <section class="footer_menu">
        <section class="footer_menu-block">
            <h3><a href="#">О прошивке</a></h3>
            <ul>
                <?if(!empty($footer_block1))
                    foreach($footer_block1 as $item) { ?>
                        <li><a href="/articles/view/<?=$item['Article']['id']?>/<?=$item['Article']['slug']?>" title="<?=$item['Article']['name']?>"><?=$item['Article']['name']?></a></li>
                    <?}?>
            </ul>
        </section>
        <section class="footer_menu-block">
            <h3><a href="#">Сотрудничество</a></h3>
            <ul>
                <?if(!empty($footer_block2))
                    foreach($footer_block2 as $item) { ?>
                        <li><a href="/articles/view/<?=$item['Article']['id']?>/<?=$item['Article']['slug']?>" title="<?=$item['Article']['name']?>"><?=$item['Article']['name']?></a></li>
                    <?}?>
            </ul>
        </section>
        <section class="footer_menu-block">
            <h3><a href="#">Полезное</a></h3>
            <ul>
                <?if(!empty($footer_block3))
                    foreach($footer_block3 as $item) { ?>
                        <li><a href="/articles/view/<?=$item['Article']['id']?>/<?=$item['Article']['slug']?>" title="<?=$item['Article']['name']?>"><?=$item['Article']['name']?></a></li>
                    <?}?>
            </ul>
        </section>
        <section class="footer_menu-block">
            <h3><a href="#">Присоединяйтесь</a></h3>
            <ul class="mini-socials">
                <li><a class="sprites-social vk-mini-ico" href="http://vk.com/club59969729" title="Proshivki.biz Вконтакте" rel="nofollow">Вконтакте</a></li>
                <li><a class="sprites-social fb-mini-ico" href="http://www.facebook.com/proshivkibiz" title="Proshivki.biz Facebook" rel="nofollow">Facebook</a></li>
                <li><a class="sprites-social tw-mini-ico" href="#" title="Proshivki.biz Twitter" rel="nofollow">Twitter</a></li>
                <li><a class="sprites-social yt-mini-ico" href="#" title="Proshivki.biz YouTube" rel="nofollow">YouTube</a></li>
                <!--<li><a class="sprites-social rss-mini-ico" href="#">RSS</a></li>-->
            </ul>
        </section>
        <div class="clr"></div>
    </section><!-- footer_menu  -->
    <div class="footer-money">
        <h4>Принимаем к оплате:</h4>
        <ul class="footer-money-list">
            <?foreach($footer_payments as $payment) {?>
                <li>
                    <a href="#" title="<?=$payment['Payment']['short_description']?>">
                        <img src="/files/images/payments/image/small/<?=$payment['Payment']['image']?>" alt="<?=$payment['Payment']['short_description']?>"/>
                    </a>
                </li>
            <?}?>
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
        <div><a href="/contacts">Все контакты</a></div>
    </div>

</footer><!-- #footer -->