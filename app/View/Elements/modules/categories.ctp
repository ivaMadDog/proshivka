<?if(!empty($categories)) :?>
    <section class="list list-dotted">
        <h3 class="list_title">Категории блога</h3>
        <ul>
            <?foreach($categories as $category) :?>
                <li><a href="/categories/index/<?=$category['id']?>/<?=$category['slug']?>" title="<?=$category['name']?>"><?=$category['name']?></a></li>
            <? endforeach;?>
        </ul>
    </section>
<?endif;?>