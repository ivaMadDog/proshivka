<header id="header" >
    <div id="bgheader" style="background: url(/files/header_bg/<?=$headerBgImg?> ) no-repeat">
        
        <?php echo $this->element('menus/top_menu');?>
        
        <?php echo $this->element('menus/main_menu');?>

        <div class="title_page"><?!empty($title_page)?$title_page:'';?></div>
        <div class="clr"></div>
    </div>    
</header><!-- #header-->