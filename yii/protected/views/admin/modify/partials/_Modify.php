<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Модификации авто</h3>
            <?php if(!empty($modify)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td05">
							#
						</td>
						<td class="td2">
							Название
						</td>
						<td class="td6">
							Описание
						</td>
						<td class="td1">
						 	Комп.
						</td>
						<td class="td05">
						 	Статус
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($modify as $modkey => $mod) { ?>
  					<tr>
						<td><?=$mod->id?></td>
						<td><?=CHtml::link($mod->title, array('admin/updatemodify', 'id'=>$mod->id, 'language'=>Yii::app()->language))?></td>
						<td><?=$mod->description?></td>
						<td><?=CHtml::link($mod->complectCount, array('admin/complect', 'id'=>$mod->id, 'language'=>Yii::app()->language))?></td>
						<td><?=$mod->is_visible ? 'Активен' : 'Скрыт'?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<hr />
			<?=CHtml::link(Yii::t('label', 'Добавить модификацию'), array('admin/createmodify', 'language'=>Yii::app()->language), array('class'=>'btn'))?>
		</div>
	</div>
</div>