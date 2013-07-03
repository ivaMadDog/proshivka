<div>
    <ul id="topmenu" class="gmenu">
        <li> 
            <?
                if(!$logged_in):
                   echo $this->html->link('Вход', array('controller'=>'users', 'action'=>'login'), array('title'=>'Вход'));
                else:
                   echo $this->html->link('Профиль', array('controller'=>'users', 'action'=>'profile'), array('title'=>'Профиль пользователя'));
                endif;    
            ?>
        </li>
        <li>
            <?
                if(!$logged_in):
                   echo $this->html->link('Регистрация', array('controller'=>'users', 'action'=>'register'), array('title'=>'Регистрация пользователя'));
                else:
                   echo $this->html->link('Выход', array('controller'=>'users', 'action'=>'logout'), array('title'=>'Выход'));
                endif;    
            ?>
        </li>
        <li id="top_contacts">
            <a  href="#" title="">+38 (097) 187 84 85</a>
            <div id="top_all_contacts" class="top_arrow" style="display: none">
                <ul class="top_bg_green">
                    <li><span class="sprite_icons_25 phone"></span>+38 (097) 187 84 85</li>
                    <li><span class="sprite_icons_25 phone"></span>+38 (097) 187 84 85</li>
                    <li><span class="sprite_icons_25 skype"></span>ivaMadDog</li>
                    <li><span class="sprite_icons_25 email"></span>office@proshivki.biz</li>
                    <li><span class="sprite_icons_25 fb"></span>vk.com/proshivki</li>
                </ul>
            </div>
        </li>
        <li id="top_feedback">
            <a  href="#" title=""></a>
        </li>
    </ul>
</div>
<div class="clr"></div>