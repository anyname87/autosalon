<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Марки авто</h3>
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
						<td class="td6">
							Описание
						</td>
						<td class="td05">
						 	Галлерея
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($model as $modkey => $mod) { ?>
  					<tr>
						<td><?=$mod->priority?></td>
						<td><img src="<?=$mod->full_img?>" alt="<?=$mod->title?>"/></td>
						<td><a href="/index.php/admin/model/update/<?=$mod->id?>"><?=$mod->title?></a></td>
						<td><?=$mod->description?></td>
						<td><a href="/admin/gallery/<?=$mod->gallery_id?>">3</a></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<a class="btn" href="/index.php/admin/model/create/<?=$group_id?>">Добавить модель</a>
		</div>
	</div>
</div>