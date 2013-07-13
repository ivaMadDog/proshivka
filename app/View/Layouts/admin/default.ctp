<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <?php echo $this->element('admin/head');?>
</head>

<body>
    <?php echo $this->Session->flash(); ?>

    <header id="header">
        <div class="wrapper">
              <a class="logo" href="/admin/administrators"><img src="/img/logo.png" title="" alt="" style="width:  140px"/></a>
              <?php echo $this->element('admin/top_menu');?>
        </div>
    </header><!-- #header-->
    
    <div class="wrapper">

            <div id="content">
                  
                <?php echo $this->element('admin/title_page');?>

                <?php echo $content_for_layout ?>

            </div><!-- #content-->

            <?php echo $this->element('admin/footer'); ?>

    </div><!-- #wrapper -->
<?php echo $this->element('sql_dump'); ?>

</body>
</html>