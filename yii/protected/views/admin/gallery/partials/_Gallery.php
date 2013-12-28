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
						<td class="td7">
							Описание
						</td>
						<td class="td05">
						 	Фотографий
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($gallery as $gkey => $g) { ?>
  					<tr>
						<td><?=$g->id?></td>
						<td><a href="/index.php/admin/gallery/update/<?=$g->id?>"><?=$g->title?></a></td>
						<td><?=$g->description?></td>
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