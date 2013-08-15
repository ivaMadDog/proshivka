<div id="container">
	<div id="content">
		<h1 class="hpage txt_green">Наши Партнеры в Украине</h1>
		<?if(!empty($data)) {?>
            <ul class="list-companies">
                <?foreach($data as $item) { ?>
                    <li class="list-companies-wrap">
                        <div class="list-companies-image" style="background: transparent url(/files/images/companies/image/preview/<?=$item[$modelName]['image']?>) center no-repeat">
                            <div class="list-companies-bg">
                                <h2 class="list-companies-name"><?=$item[$modelName]['name']?></h2>
                            </div>
                        </div> 
                        <div class="list-companies-body">
                            <ul>
                                <li class="list-companies-city"><?=$item['City']['name']?></li>
                                <li class="list-companies-address"><?=$item[$modelName]['address']?></li>
                                <li class="list-companies-phone"><?=$item[$modelName]['phone_work']?></li>
                                <li class="list-companies-email"><?=$item[$modelName]['email']?></li>
                            </ul>
                            <?if(!empty($item[$modelName]['xls'])) {?>
                                <div class="list-companies-price" style="display: none">
                                    <a href="/files/<?=$controllerName?>/xls/<?=$item[$modelName]['xls']?>" class="form-btn-blue list-companies-price-link">Цены</a>
                                </div>
                            <?}?>
                        </div>
                    </li>
                <?}?>
            </ul>
		<?} else {?>
			<section>Нет данных, зайдите пожалуйста позже.</section>
		<?}?>
	</div><!-- #content-->
</div><!-- #container-->


<script type="text/javascript">
    $(document).ready(function(){
        $('.list-companies-body').mouseenter(function() {
            $(this).children('.list-companies-price').fadeIn(300).delay(2500).slideUp(200);
        });
    });
</script>