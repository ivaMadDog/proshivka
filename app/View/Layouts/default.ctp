<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title><?php echo $title_for_layout;?></title>
	
        <?php echo $this->element('meta_tags'); ?>
        
        <?php echo $this->element('head');?>
</head>

<body class="header-lblue">

<div id="wrapper" >

        <?php echo $this->element('header');?>

	<section id="middle">
		<div id="container">
                    
			<div id="content">
                           
                             <?php echo $content_for_layout ?>
                            
                             <?php echo $this->element('bottom');?>
                            
                        </div><!-- #content-->
		</div><!-- #container-->

	</section><!-- #middle-->

        <?php echo $this->element('footer');?>

</div><!-- #wrapper -->
<?php  if(Configure::read('debug')>=1) echo $this->element('sql_dump'); ?>
</body>
</html>