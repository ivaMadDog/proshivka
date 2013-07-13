<title><?php echo $title_for_layout;?></title>

<?php  
echo $this->Html->charset('utf-8');

  echo $this->Html->css('jquery/jquery-ui-1.10.2.custom');
  echo $this->html->css('reset');
  echo $this->html->css('admin/style');
  echo $this->html->css('../js/fancybox/jquery.fancybox');
?>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<?php  
  echo $this->html->script('jquery/jquery-1.9.1.min.js');
  echo $this->html->script('jquery/jquery-ui-1.10.2.custom.min.js');
  echo $this->html->script('fancybox/jquery.fancybox.pack.js');
  echo $this->html->script('jquery/jquery.liveFilter.js');
 // echo $this->html->script('jquery/jquery.cycle.all.js');
  echo $this->html->script('jquery/jquery.placeholder.js');
  echo $this->html->script('jquery/validate.js');
  echo $this->html->script('admin/default.js');
?>
