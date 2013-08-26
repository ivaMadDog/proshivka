<title><?php echo $title_for_layout;?></title>

<?php
  echo $this->Html->charset('utf-8');

  echo $this->Html->css('jquery/jquery-ui-1.10.2.custom');
  echo $this->html->css('../js/fancybox/jquery.fancybox');
  echo $this->html->css('reset');
  echo $this->html->css('admin/style');
?>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<?php
  echo $this->html->script('jquery/jquery-1.9.1.min');
  echo $this->html->script('jquery/jquery-ui-1.10.2.custom.min');
  echo $this->html->script('fancybox/jquery.fancybox.pack');
  echo $this->html->script('jquery/jquery.liveFilter');
  echo $this->html->script('jquery/jquery.cycle.all.js');
  echo $this->html->script('jquery/jquery.placeholder');
  echo $this->html->script('jquery/validate');
  echo $this->html->script('all');
  echo $this->html->script('admin/default');
?>

