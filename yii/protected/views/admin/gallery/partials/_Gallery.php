<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Галлерея</h3>
            <?php if(!empty($gallery)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td05">
							#
						</td>
						<td class="td2">
							Название
						</td>
						<td class="td3">
							Описание
						</td>
						<td class="td2">
							Марки
						</td>
						<td class="td2">
							Модели
						</td>
						<td class="td05">
						 	Фото
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($gallery as $gkey => $g) { ?>
  					<tr>
						<td><?=$g->id?></td>
						<td><?=CHtml::link($g->title, array('admin/updategallery', 'id'=>$g->id, 'language'=>Yii::app()->language))?></td>
						<td><?=$g->description?></td>
						<td>
						<?php foreach ($g->mark as $mkey => $m)
								echo CHtml::link($m->title, array('admin/updatemark', 'id'=>$m->id, 'language'=>Yii::app()->language))."<br />"?>
						</td>
						<td>
						<?php foreach ($g->model as $modkey => $mod)
								echo CHtml::link("{$mod->mark->title} {$mod->title}", array('admin/updatemodel', 'id'=>$mod->id, 'language'=>Yii::app()->language))."<br />"?>
						</td>
						<td><?=CHtml::link($g->photoCount, array('admin/photo', 'id'=>$g->id))?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<?=CHtml::link(Yii::t('label', 'Добавить галлерею'), array('admin/creategallery', 'language'=>Yii::app()->language), array('class'=>'btn'))?>
		</div>
	</div>
</div>