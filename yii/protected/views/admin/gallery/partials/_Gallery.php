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
						<td><a href="/index.php/admin/gallery/update/<?=$g->id?>"><?=$g->title?></a></td>
						<td><?=$g->description?></td>
						<td>
						<?php foreach ($g->mark as $mkey => $m) {?>
							<a href="/index.php/admin/mark/update/<?=$m->id?>"><?=$m->title?></a><br />		  	
						<?php } ?>
						</td>
						<td>
						<?php foreach ($g->model as $modkey => $mod) {?>
							<a href="/index.php/admin/model/update/<?=$mod->id?>"><?=$mod->mark->title?> <?=$mod->title?></a><br />		  	
						<?php } ?>
						</td>
						<td><a href="/index.php/admin/photo/<?=$g->id?>"><?=$g->photoCount?></a></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<a class="btn" href="/index.php/admin/gallery/create">Добавить галлерею</a>
		</div>
	</div>
</div>