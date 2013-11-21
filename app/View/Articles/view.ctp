<div id="container">
	<div id="content">
		<h1 class="hpage txt_blue">Полезные статьи и последние новости</h1>
		<div class="clr"></div>
		<div id="content_aside">
				<article class="blog-post blog-post-shadow">
					 <div>
						<header class="blog-post-header">

							<h1 class="blog-post-title blog-view">
								<a href="/articles/view/<?=$item[$modelName]['id']?>/<?=$item[$modelName]['slug']?>"><?=$item[$modelName]['name']?></a>
							</h1>
							<ul class="blog-post-info blog-view">
								<li class="blog-post-avtor">Автор: <?=$item['User']['username']?></li>
								<li class="blog-post-category"><a href="/articles/index/<?=$item['Category']['id']?>/<?=$item['Category']['slug']?>"><?=$item['Category']['name']?></a></li>
								<li class="blog-post-category"><?= date("d.m.Y", strtotime($item[$modelName]['date']));?></li>
							</ul>
							<div class="clear"></div>
                            <? if(!empty($item[$modelName]['image'])) {?>
							<a class="blog-post-photo fancybox"
								   href="/files/images/<?=$folderName?>/image/original/<?=$item[$modelName]['image']?>"
								   style="background: url(/files/images/<?=$folderName?>/image/preview/<?=$item[$modelName]['image']?> ) no-repeat center">
								<span class="sprite-icons loupe"></span>
							</a>
                            <?}?>
						</header>
						<div class="blog-post-article">
						   <?=$item[$modelName]['full_description']?>
						</div>

						<footer class="blog-post-footer">
							<?if(!empty($neighbors['next'])) {?>
								<a href="/<?=$controllerName?>/view/<?=$neighbors['next'][$modelName]['id']?>/<?=$neighbors['next'][$modelName]['slug']?>" class="blog-post-btn next" title="Следующая статья"></a>
							<?}if(!empty($neighbors['prev'])) {?>
								<a href="/<?=$controllerName?>/view/<?=$neighbors['prev'][$modelName]['id']?>/<?=$neighbors['prev'][$modelName]['slug']?>" class="blog-post-btn prev" title="Предыдущая статья"></a>
							<?}?>
							<ul class="list-socials-icon">
								<!--<li><a href="#" class="sprite-blog-social em"></a></li>-->
								<li><a href="http://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?=Router::url( $this->here, true )?>" class="sprite-blog-social tw" title="Рассказать друзьям на Twitter"></a></li>
								<li><a href="http://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?=Router::url( $this->here, true )?>" class="sprite-blog-social fb" title="Рассказать друзьям на Facebook"></a></li>
								<!--<li><a href="#" class="sprite-blog-social yt"></a></li>-->
								<li><a href="http://api.addthis.com/oexchange/0.8/forward/vk/offer?url=<?=Router::url( $this->here, true )?>" class="sprite-blog-social vk"title="Рассказать друзьям на Vkontakte"></a></li>
							</ul>
							<div style="clear: both"></div>
						</footer>
					</div>
				</article>

			<section class="blog-comments">

			</section>
		</div><!-- #content_aside-->
	</div><!-- #content-->
</div><!-- #container-->

<aside id="sideRight" class="top-indent">

	<?=$this->element('modules/categories')?>

	<?=$this->element('modules/article_popular')?>

	<?=$this->element('modules/article_recommend')?>

</aside><!-- #sideRight -->

