<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
			<?php if((!empty($group_id))&&(isset($model[0]))): ?>
				<h3>Модели <a href='/index.php/admin/mark/update/<?=$model[0]->mark->id?>'><?=$model[0]->mark->title?></a></h3>
			<?php else: ?>
				<h3>Модели авто</h3>
			<?php endif;?>
            <?php if(!empty($model)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td05">
							Вес
						</td>
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
						<td class="td05">
						 	Статус
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php mb_internal_encoding("UTF-8");?>
  					<?php foreach ($model as $modkey => $mod) { ?>
  					<tr>
						<td><?=$mod->priority?></td>
						<td><img src="<?=$mod->full_img?>" alt="<?=$mod->title?>"/></td>
						<td><a href="<?=$this->createUrl('admin/updatemodel',array('id'=>$mod->id))?>"><?=$mod->title?></a></td>
						<td><?=mb_substr($mod->description, 0, 100)?>...</td>
						<td><a href="<?=$this->createUrl('admin/complect',array('model'=>$mod->id))?>"><?=$mod->complectCount?></a></td>
						<td><a href="<?=$this->createUrl('admin/gallery',array('id'=>$mod->gallery_id))?>">Перейти</a></td>
						<td><?=$mod->is_visible ? 'Активен' : 'Скрыт'?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<hr />
			<a class="btn" href="<?=$this->createUrl('admin/createmodel',array('id'=>$group_id))?>">Добавить модель</a>
		</div>
	</div>
</div>