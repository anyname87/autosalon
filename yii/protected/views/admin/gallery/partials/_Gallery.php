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
						<td><a href="<?=$this->createUrl('admin/updategallery',array('id'=>$g->id))?>"><?=$g->title?></a></td>
						<td><?=$g->description?></td>
						<td>
						<?php foreach ($g->mark as $mkey => $m) {?>
							<a href="<?=$this->createUrl('admin/updatemark',array('id'=>$m->id))?>"><?=$m->title?></a><br />		  	
						<?php } ?>
						</td>
						<td>
						<?php foreach ($g->model as $modkey => $mod) {?>
							<a href="<?=$this->createUrl('admin/updatemodel',array('id'=>$mod->id))?>"><?=$mod->mark->title?> <?=$mod->title?></a><br />		  	
						<?php } ?>
						</td>
						<td><a href="<?=$this->createUrl('admin/photo',array('id'=>$g->id))?>"><?=$g->photoCount?></a></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<a class="btn" href="<?=$this->createUrl('admin/creategallery')?>">Добавить галлерею</a>
		</div>
	</div>
</div>