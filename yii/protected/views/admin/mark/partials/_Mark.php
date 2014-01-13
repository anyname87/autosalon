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
						<td><a href="<?=$this->createUrl('admin/updatemark',array('id'=>$m->id))?>"><?=$m->title?></a></td>
						<td><?=$m->description?></td>
						<td><a href="<?=$this->createUrl('admin/model',array('id'=>$m->id))?>"><?=$m->modelCount?></a></td>
						<td><?=$m->is_visible ? Yii::t('label', 'Активен') : Yii::t('label', 'Скрыт')?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<hr />
			<a class="btn" href="<?=$this->createUrl('admin/createmark')?>"><?=Yii::t('label', 'Добавить марку')?></a>
		</div>
	</div>
</div>