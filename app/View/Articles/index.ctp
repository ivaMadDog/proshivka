<?  // debug($data)?>
<h1 class="hpage txt_orange">Полезные статьи и новости</h1>
<div class="clr"></div>
<div id="content_aside">

<section class="blog-posts">
    <? if(!empty($data)) :?>
        <? foreach($data as $item) : ?>
            <article class="blog-post blog-post-shadow">
                 <div>    
                    <header class="blog-post-header">
                        <a class="blog-post-photo"  
                           href="/articles/view/<?=$item[$modelName]['id']?>/<?=$item[$modelName]['slug']?>" 
                           style="background: url(/files/images/<?=$folderName?>/image/preview/<?=$item[$modelName]['image']?> ) no-repeat center"></a>
                        <h1 class="blog-post-title"><a href="/articles/view/<?=$item[$modelName]['id']?>/<?=$item[$modelName]['slug']?>"><?=$item[$modelName]['name']?></a></h1>
                        <ul class="blog-post-info">
                            <li class="blog-post-avtor">Автор: <?=$item['User']['username']?></li>
                            <li class="blog-post-category"><a href="/articles/index/<?=$item['Category']['id']?>/<?=$item['Category']['slug']?>"><?=$item['Category']['name']?></a></li>
                            <li class="blog-post-comments">17 комментариев</li>
                        </ul>
                        <time class="blog-post-date">
                            <div class="blog-post-month"><?=date("m",strtotime($item[$modelName]['date']));?></div>
                            <div class="blog-post-day"><?=date("d",strtotime($item[$modelName]['date']));?></div>
                            <div class="blog-post-year"><?=date("Y",strtotime($item[$modelName]['date']));?></div>
                        </time>
                    </header>
                    <p class="blog-post-article">
                        <?=$item[$modelName]['short_description']?>
                    </p>

                    <footer class="blog-post-footer">
                        <a href="/articles/view/<?=$item[$modelName]['id']?>/<?=$item[$modelName]['slug']?>" class="blog-post-readmore"></a>
                        <ul class="list-socials-icon">
                            <li><a href="#" class="sprite-blog-social em"></a></li>
                            <li><a href="#" class="sprite-blog-social tw"></a></li>
                            <li><a href="#" class="sprite-blog-social fb"></a></li>
                            <li><a href="#" class="sprite-blog-social yt"></a></li>
                            <li><a href="#" class="sprite-blog-social vk"></a></li>
                        </ul>
                        <div style="clear: both"></div>
                    </footer>
                </div>
            </article>
        <? endforeach;?>
        <div class="clear"></div>

        <?=$this->element('pagin_ui')?>
    
      <?else :?>  
            <div>Данная категория пустая.</div>
      <?endif;?>  
</section><!-- end blog post-->



</div><!-- #content-->