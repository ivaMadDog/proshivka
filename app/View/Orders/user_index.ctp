<div id="container">
	<div id="content">
			<h1 class="hpage txt_purple">Кабинет пользователя</h1>

			<section class="user-page">

				<?php echo $this->element('menus/user_menu');?>

				<section class="user-page-body">
					<div>
<!--						<form action="#">
							<div class="form-row">
								<div class="form-row-value ">
									<input class="border_grey" type="text" name="filter_date" value="" placeholder="Фильтр по дате" data-placeholder="Фильтр по дате"/>
									<input class="border_grey" type="text" name="filter_status" value="" placeholder="Фильтр по статусу" data-placeholder="Фильтр по статусу"/>
									<input class="border_grey" type="text" name="filter_model" value="" placeholder="Фильтр по модели" data-placeholder="Фильтр по модели"/>
									<input class="btn_form btn_orange rght" type="button" name="submit" value="Поиск" />
								</div>
							</div>
						</form>-->
							<div class="form-row">
								<div class="form-row-label">
									Всего заказов
								</div>
								<div class="form-row-value">
									<?= !empty($summary['summary_qty'])?$summary['summary_qty']:'0 ';?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-row-label">
									Общая сумма заказов
								</div>
								<div class="form-row-value">
									<?= !empty($summary['summary_price'])?$summary['summary_price']:'0 ';?> грн.
								</div>
							</div>
							<div class="form-row">
								<div class="rnd5" style="padding: 5px 0 0">
									<table class="user-orders-list">
										<tr class="user-orders-list-title">
											<td><div>Дата заказа</div></td>
											<td><div>Модель принтера</div></td>
											<td><div>Сумма (грн.)</div></td>
											<td><div>Дата выполнения</div></td>
											<td><div>Статус</div></td>
										</tr>
										<?foreach($data as $item) {?>
											<tr class="user-orders-list-data">
												<td>
													<div>
														<?=date("d-m-Y G:i:s", strtotime($item['Order']['created']))?>
													</div>
												</td>
												<td>
													<div>
														<a href="/printers/view/<?=$item['Printer']['id']?>/<?=$item['Printer']['slug']?>" title="Подробнее о принтере <?=$item['Printer']['name']?>">
															<?=$item['Printer']['name']?>
														</a>
													</div>
												</td>
												<td>
													<div>
														<?=$item['Order']['price']?>
													</div>
												</td>
												<td>
													<div>
														<?=date("d-m-Y G:i:s", strtotime($item['Order']['modified']))?>
													</div>
												</td>
												<td>
													<div>
														<? if(empty($item['Order']['fix_link'])) {echo $item['OrderType']['name']; }else {?>
														<a class="user-orders-fix-link" href="/files/fixes/<?=$item['Order']['fix_link']?>">Скачать</a>
														<?}?>
													</div>
												</td>
											</tr>
										<?}?>
									</table>
									<div class="user-orders-list-footer">
										<div class="pagin">
											<?= $this->Paginator->first("<<", array(), null, array('class' => 'prev disabled'))?>
											<?= $this->Paginator->numbers(array('modulus'=>2, 'separator'=>' ')) ?>
											<?= $this->Paginator->last(">>", array(), null, array('class' => 'next disabled'))?>
										</div>
									</div>
								</div>
							</div>
					</div>
				</section>

			</section>

<!--			<section class="banner_center">
				<a href="#"><img src="/files/banners/banner_order_fix.png"/></a>
			</section>-->

	</div><!-- #content-->
</div><!-- #container-->