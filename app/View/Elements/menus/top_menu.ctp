<div>
    <ul id="topmenu" class="gmenu">
        <li>
            <?
                if(!$logged_in):
                   echo $this->html->link('Вход', array('controller'=>'users', 'action'=>'login', 'user'=>false), array('title'=>'Вход'));
                else:
                   echo $this->html->link('Профиль', array('controller'=>'users', 'action'=>'profile','user'=>true), array('title'=>'Профиль пользователя'));
                endif;
            ?>
        </li>
        <li>
            <?
                if(!$logged_in):
                   echo $this->html->link('Регистрация', array('controller'=>'users', 'action'=>'register', 'user'=>false), array('title'=>'Регистрация пользователя'));
                else:
                   echo $this->html->link('Выход', array('controller'=>'users', 'action'=>'logout','user'=>false), array('title'=>'Выход'));
                endif;
            ?>
        </li>
        <li id="top_contacts">
            <a  href="#" title=""><?=($contacts['Default']['Contact']['name'])?></a>
			<?if (!empty($contacts['Others'])) {?>
				<div id="top_all_contacts" class="top_arrow" style="display: none">
					<ul class="top_bg_green">
						<?foreach($contacts['Others'] as $contact) {?>
							<li><span class="sprite_icons_25 <?=$contact['Contact']['type']?>"></span><?=$contact['Contact']['name']?></li>
						<?}?>
					</ul>
				</div>
			<?}?>
        </li>
        <li id="top_feedback">
            <a  href="#" title=""></a>
        </li>
    </ul>
</div>
<div class="clr"></div>