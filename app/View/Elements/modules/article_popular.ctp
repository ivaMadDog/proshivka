<?if(!empty($articles_views)) { ?>
    <section class="list list-popular">
        <h3 class="list_title">ПОПУЛЯРНЫЕ СТАТЬИ</h3>
        <ul>
            <?  foreach ($articles_views as $article) {
                $articleLink="/$controllerName/view/{$article[$modelName]['id']}/{$article[$modelName]['slug']}";
                $articleImage=(!empty($article[$modelName]['image']))?"/files/images/$controllerName/image/thumb/{$article[$modelName]['image']}":
                    "/img/bg_blog_mini_img.png"; 
            ?>
                <li>
                    <p class="list-popular-shadow">
                        <a class="list-popular-img" style="background: #fff url(<?=$articleImage?>) no-repeat center" href="<?=$articleLink?>"></a>
                    </p>
                    <h4 class="list-popular-title" ><a href="<?=$articleLink?>"><?=$article[$modelName]['name']?></a></h4>
                    <p class="list-popular-descr">
                        <a href="<?=$articleLink?>">
                            <?= $this->Text->truncate($article[$modelName]['short_description'], 60, array('ellipsis' => '...','exact' => false));?>
                        </a>
                    </p>
                    <div class="clr"></div>
                </li>
            <?}?>
        </ul>
    </section>
<?}?>