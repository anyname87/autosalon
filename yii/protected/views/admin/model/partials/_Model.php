<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
			<?php if((!empty($group_id))&&(isset($model[0]))): ?>
				<h3>Модели <?=CHtml::link($model[0]->mark->title, array('admin/updatemark', 'id'=>$model[0]->mark->id, 'language'=>Yii::app()->language))?></h3>	
			<?php else: ?>
				<h3>Модели авто</h3>
			<?php endif;?>
            <?php if(!empty($model)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td1">
							Фотография
						</td>
						<td class="td2">
							Название
						</td>
						<td class="td5">
							Описание
						</td>
						<td class="td05">
						 	Комп.
						</td>
						<td class="td05">
						 	Галлерея
						</td>
						<td class="td1">
						 	Статус
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php mb_internal_encoding("UTF-8");?>
  					<?php foreach ($model as $modkey => $mod) { ?>
  					<tr>
						<td><img src="<?=$mod->full_img?>" alt="<?=$mod->title?>"/></td>
						<td><?=CHtml::link($mod->title, array('admin/updatemodel', 'id'=>$mod->id, 'language'=>Yii::app()->language))?></td>
						<td><?=mb_substr($mod->description, 0, 100)?>...</td>
						<td><?=CHtml::link($mod->complectCount, array('admin/complect', 'model'=>$mod->id, 'language'=>Yii::app()->language))?></td>
						<td><?=CHtml::link(Yii::t('label', 'Перейти'), array('admin/gallery', 'id'=>$mod->gallery_id, 'language'=>Yii::app()->language))?></td>
						<td><?=$mod->is_visible ? 'Активен' : 'Скрыт'?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<hr />
			<?=CHtml::link(Yii::t('label', 'Добавить модель'), array('admin/createmodel', 'id'=>$group_id, 'language'=>Yii::app()->language), array('class'=>'btn'))?>
		</div>
	</div>
</div>