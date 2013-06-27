<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Administration Interface</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" href="<?php echo $this->webroot . 'img/favicon.ico'; ?>" type="image/x-icon" />
	<!-- link rel="stylesheet" type="text/css" href="/js/jquery/lightbox/css/default.css" />
	<script type="text/javascript" src="/js/admin/jquery.php"></script>
	<script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="/js/admin/default.js"></script -->
	<?php echo $this->Html->css('admin/default'); ?>
</head>
<body id="layout_login">
<div id="wrap">

<h1><img src="/css/admin/img/logo.jpg" alt="NetDesignPlus sarl"/></h1>

<p id="backoffice_img"><img src="/css/admin/img/logo_index.jpg" alt="Back-office Administration Interface"/></p>

<?php echo $this->Session->flash(); ?>
<div id="content"><?php echo $content_for_layout; ?></div>
<p id="footer">Copyright &copy; NetDesignPlus sarl. All rights reserved.</p>


</div>

</body>
</html>