<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title><?php echo $title_for_layout;?></title>

        <?php echo $this->element('meta_tags'); ?>

        <?php echo $this->element('head');?>
</head>

<body class="<?php echo $headerColor ?>">
    <?php echo $this->Session->flash(); ?>
    <div id="wrapper" >
            <?php echo $this->element('header');?>

        <section id="middle">

			<?php echo $content_for_layout ?>
            <div class="clr"></div>
            <?php echo $this->element('bottom');?>

        </section><!-- #middle-->

		<div class="clr"></div>
        <?php echo $this->element('footer');?>

    </div><!-- #wrapper -->
    <div class="clear"></div>

    <pre>
    <?php echo $this->element('sql_dump'); ?>
    </pre>
</body>
</html>