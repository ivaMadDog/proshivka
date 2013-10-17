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
            <div id="container">
                <div id="content">
                     <?php echo $content_for_layout ?>
                     <div class="clr"></div>
                     <?php echo $this->element('bottom');?>
                </div><!-- #content-->
            </div><!-- #container-->
        </section><!-- #middle-->

            <?php echo $this->element('footer');?>

    </div><!-- #wrapper -->
    <div class="clear"></div>
    <!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter22267027 = new Ya.Metrika({id:22267027, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/22267027" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->    
    <pre>
    <?php echo $this->element('sql_dump'); ?> 
    </pre>
</body>
</html>