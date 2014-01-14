<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Комплектация авто</h3>
            <?php if(!empty($complect)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td1">
							#
						</td>
						<td class="td2">
							Название
						</td>
						<td class="td3">
							Описание
						</td>
						<td class="td2">
							Модель
						</td>
						<td class="td1">
							Модификация
						</td>
						<td class="td05">
						 	Цена
						</td>
						<td class="td05">
						 	Статус
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($complect as $compkey => $comp) { ?>
  					<tr>
						<td><?=$comp->id?></td>
						<td><?=CHtml::link($comp->title, array('admin/updatecomplect', 'id'=>$comp->id, 'language'=>Yii::app()->language))?></td>
						<td><?=$comp->description?></td>
						<td><?=CHtml::link("{$comp->model->mark->title} {$comp->model->title}", array('admin/updatemodel', 'id'=>$comp->model->id, 'language'=>Yii::app()->language))?></td>
						<td><?=CHtml::link($comp->modify->title, array('admin/updatemodify', 'id'=>$comp->modify->id, 'language'=>Yii::app()->language))?></td>
						<td><?=$comp->price?></td>
						<td><?=$comp->is_visible ? 'Активен' : 'Скрыт'?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<hr />
			<?=CHtml::link(Yii::t('label', 'Добавить комплектацию'), array('admin/createcomplect', 'language'=>Yii::app()->language), array('class'=>'btn'))?>
		</div>
	</div>
</div>