<div>
    <ul id="topmenu" class="gmenu">
        <li>
            <?=$this->html->link('Вход', array('controller'=>'users', 'action'=>'login'), array('title'=>'Вход'));?>
        </li>
        <li>
            <?=$this->html->link('Регистрация', array('controller'=>'users', 'action'=>'register'), array('title'=>'Регистрация'));?>
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