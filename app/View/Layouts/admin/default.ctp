<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Administration Interface</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" href="<?php echo $this->webroot . 'img/favicon.ico'; ?>" type="image/x-icon" />
	
	<link rel="stylesheet" type="text/css" href="/js/jquery/lightbox/css/default.css" />
	<script type="text/javascript" src="/js/admin/jquery.php"></script>
	<script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
	
	<?php echo $this->Html->css('admin/default'); ?>
	<?php echo $this->Html->css('uicustom/uicustom.css'); ?>
	<?php echo $this->html->css('colorpicker/css/jquery.colorpicker.css'); ?>
</head>
<body id="<?=$this->request->controller.'-'.$this->request->action?>">
	
<h1>
	<img src="/css/admin/img/logo.jpg" alt="NetDesignPlus sarl"/>
	<img src="/css/admin/img/logo_index.jpg" alt=""/>
</h1>

<div class="announcement_text atfirst">
	<h2>Welcome to the Administration Interface</h2>
	<p>This is an easy-to-use administration that allows you to manage the sections of your website. There are several sections in general in addition to the links that allow you to change your password. </p>
</div>

<div class="announcement_text">
	<h2>Change your password frequently</h2>
	<p>A good security practice is that you change your password on a frequent basis (every 5-6 months).<br />
		To do so, please click on Edit Password from the menu on the left...</p>
</div>
<br class="clean"/>

<div id="ww-content">
	<h2 id="welcome"><span>Welcome <?php  echo $adminname?></span></h2>
	<!--   Menu @begin  -->
	<div id="menu">
		<?php $menuFlag = isset($menuFlag_for_layout)?$menuFlag_for_layout:(isset($menuFlag)?$menuFlag:null);
		echo $this->element('admin/menu', array("menuFlag" => $menuFlag, "level"=>$level)); 
		?>
	</div>
	<!--  Menu @end     -->

	<!-- content @begin  -->
	<?php echo $this->Session->flash(); ?>
	<div id="page_content"><?php echo $content_for_layout; ?></div>
	<!-- / content @end  -->
	
	<div id="tmp_data" style="display:none;"></div>
	
</div>
	
<!-- Footer -->
<div id="footer">
Copyright &copy; <a href="http://netdesignplus.net" target="_blank">NetDesignPlus sarl</a>. All rights reserved.
</div>
<!-- / Footer -->


<?php echo $this->element('sql_dump'); ?>

</body>
</html>