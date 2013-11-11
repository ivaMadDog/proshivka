<?
  echo $this->Html->charset('utf-8');

  echo $this->Html->css('jquery/jquery-ui-1.10.2.custom');
  echo $this->html->css('jquery/ui.totop.css');
  echo $this->html->css('reset');
  echo $this->html->css('style');
  echo $this->html->css('../js/fancybox/jquery.fancybox');
  echo $this->html->css('../js/fancybox/helpers/jquery.fancybox-thumbs');
  
  
?>
<!--[if IE]><link rel="stylesheet" href="css/ie.css" type="text/css"  /><![endif]-->
<?
  echo $this->html->script('jquery/jquery-1.9.1.min');
  echo $this->html->script('jquery/jquery-ui-1.10.2.custom.min');
  echo $this->html->script('fancybox/jquery.fancybox.pack');
  echo $this->html->script('fancybox/helpers/jquery.fancybox-media');
  echo $this->html->script('fancybox/helpers/jquery.fancybox-thumbs');
  echo $this->html->script('jquery/jquery.fastLiveFilter');
  echo $this->html->script('jquery/jquery.ui.totop.js');
  echo $this->html->script('jquery/jquery.cycle.all.js');
  echo $this->html->script('jquery/jquery.placeholder');
  echo $this->html->script('jquery/validate');
  echo $this->html->script('jquery/jquery.scrollTo');
  echo $this->html->script('jquery/jquery.localscroll');
  echo $this->html->script('all');
  echo $this->html->script('default');
?>

<script type="text/javascript" src="http://api.recaptcha.net/js/recaptcha_ajax.js"></script>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>
<script type="text/javascript">VK.init({apiId: 3943985, onlyWidgets: true});</script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">