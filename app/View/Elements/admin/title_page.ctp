<?php if(!empty($cp_title) || !empty($cp_subtitle)) {?>
    <div class="cp_header">
    <!--    <div class="cp_command">
            <a href="#">Мой профиль</a>
        </div>-->
        <div class="cp_title">
            <?php echo !empty($cp_title)? $cp_title: '';?>
            <?php echo !empty($cp_subtitle)? ' - '.$cp_subtitle: '';?>
        </div>
    </div>  
<?php } ?>