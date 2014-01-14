<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Контент</h3>
            <?php if(!empty($page)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td1">
							#
						</td>
						<td class="td3">
							Группа
						</td>
						<td class="td3">
							Заголовок
						</td>
						<td class="td3">
							Теги
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($page as $pkey => $p) { ?>
  					<tr>
						<td><?=$p->id?></td>
						<td><?=$p->groupPage->title?></td>
						<td><?=CHtml::link($p->title, array('admin/updatepage', 'id'=>$p->id, 'language'=>Yii::app()->language))?></td>
						<td><?=Tag::array2string(CHtml::listData($p->tags, 'id', 'name'))?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<hr />
			<?=CHtml::link(Yii::t('label', 'Добавить контент'), array('admin/createpage', 'language'=>Yii::app()->language), array('class'=>'btn'))?>
		</div>
	</div>
</div>