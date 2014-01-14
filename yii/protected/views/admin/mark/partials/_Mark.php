<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3><?=Yii::t('label', 'Марки авто')?></h3>
            <?php if(!empty($mark)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td1">
							<?=Yii::t('label', 'Лого')?>
						</td>
						<td class="td2">
							<?=Yii::t('label', 'Название')?>
						</td>
						<td class="td6">
							<?=Yii::t('label', 'Описание')?>
						</td>
						<td class="td05">
						 	<?=Yii::t('label', 'Мод.')?>
						</td>
						<td class="td05">
						 	<?=Yii::t('label', 'Статус')?>
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($mark as $mkey => $m) { ?>
  					<tr>
						<td><img src="<?=$m->small_img?>" alt="<?=$m->title?>"/></td>
						<td><?=CHtml::link($m->title, array('admin/updatemark', 'id'=>$m->id, 'language'=>Yii::app()->language))?></td>
						<td><?=$m->description?></td>
						<td><?=CHtml::link($m->modelCount, array('admin/model', 'id'=>$m->id, 'language'=>Yii::app()->language))?></td>
						<td><?=$m->is_visible ? Yii::t('label', 'Активен') : Yii::t('label', 'Скрыт')?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<hr />
			<?=CHtml::link(Yii::t('label', 'Добавить марку'), array('admin/createmark', 'id'=>$m->id, 'language'=>Yii::app()->language), array('class'=>'btn'))?>
		</div>
	</div>
</div>