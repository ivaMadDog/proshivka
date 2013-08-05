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

                </div><!-- #content-->
            </div><!-- #container-->
            <aside id="sideRight" class="top-indent">
                <section class="list list-dotted">
                    <h3 class="list_title">Категории блога</h3>
                    <ul>
                        <li><a href="#">Новости сервиса</a></li>
                        <li><a href="#">Новинки в мире принтера</a></li>
                        <li class="active"><a href="#">Технологии</a></li>
                        <li><a href="#">Прошивки</a></li>
                        <li><a href="#">Расходные материалы</a></li>
                    </ul>
                </section>

                <section class="list list-popular">
                    <h3 class="list_title">ПОПУЛЯРНЫЕ СТАТЬИ</h3>
                    <ul>
                        <li>
                            <p class="list-popular-shadow">
                                <a class="list-popular-img" style="background: #fff url(files/pomidor.png) no-repeat center" href="#"></a>
                            </p>
                            <h4 class="list-popular-title" ><a href="#">This is a sample Post 1</a></h4>
                            <p class="list-popular-descr">
                                <a href="#">Lorem ipsum dolor sit amet, 
                                sed diam nonummy nibh...
                                </a>
                            </p>
                            <div class="clr"></div>
                        </li>
                        <li>
                            <p class="list-popular-shadow">
                                <a class="list-popular-img" style="background: #fff url(files/klybnika.png) no-repeat center" href="#"></a>
                            </p>
                            <h4 class="list-popular-title" ><a href="#">This is a sample Post 1</a></h4>
                            <p class="list-popular-descr">
                                <a href="#">Lorem ipsum dolor sit amet, 
                                sed diam nonummy nibh...
                                </a>
                            </p>
                            <div class="clr"></div>
                        </li>
                        <li>
                            <p class="list-popular-shadow">
                                <a class="list-popular-img" style="background: #fff url(files/rouse.png) no-repeat center" href="#"></a>
                            </p>
                            <h4 class="list-popular-title" ><a href="#">This is a sample Post 1</a></h4>
                            <p class="list-popular-descr">
                                <a href="#">Lorem ipsum dolor sit amet, 
                                sed diam nonummy nibh...
                                </a>
                            </p>
                            <div class="clr"></div>
                        </li>
                    </ul>
                </section>

                <section class="list list-popular">
                    <h3 class="list_title">рекомендуем</h3>
                    <ul>
                        <li>
                            <p class="list-popular-shadow">
                                <a class="list-popular-img" style="background: #fff url(files/pomidor.png) no-repeat center" href="#"></a>
                            </p>
                            <h4 class="list-popular-title" ><a href="#">This is a sample Post 1</a></h4>
                            <p class="list-popular-descr">
                                <a href="#">Lorem ipsum dolor sit amet, 
                                sed diam nonummy nibh...
                                </a>
                            </p>
                            <div class="clr"></div>
                        </li>
                        <li>
                            <p class="list-popular-shadow">
                                <a class="list-popular-img" style="background: #fff url(files/klybnika.png) no-repeat center" href="#"></a>
                            </p>
                            <h4 class="list-popular-title" ><a href="#">This is a sample Post 1</a></h4>
                            <p class="list-popular-descr">
                                <a href="#">Lorem ipsum dolor sit amet, 
                                sed diam nonummy nibh...
                                </a>
                            </p>
                            <div class="clr"></div>
                        </li>
                        <li>
                            <p class="list-popular-shadow">
                                <a class="list-popular-img" style="background: #fff url(files/rouse.png) no-repeat center" href="#"></a>
                            </p>
                            <h4 class="list-popular-title" ><a href="#">This is a sample Post 1</a></h4>
                            <p class="list-popular-descr">
                                <a href="#">Lorem ipsum dolor sit amet, 
                                sed diam nonummy nibh...
                                </a>
                            </p>
                            <div class="clr"></div>
                        </li>
                    </ul>
                </section>
            </aside><!-- #sideRight -->
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