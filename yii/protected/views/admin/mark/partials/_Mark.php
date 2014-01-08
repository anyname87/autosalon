<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Марки авто</h3>
            <?php if(!empty($mark)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td05">
							Вес
						</td>
						<td class="td05">
							Лого
						</td>
						<td class="td2">
							Название
						</td>
						<td class="td6">
							Описание
						</td>
						<td class="td05">
						 	Мод.
						</td>
						<td class="td05">
						 	Статус
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($mark as $mkey => $m) { ?>
  					<tr>
						<td><?=$m->priority?></td>
						<td><img src="<?=$m->small_img?>" alt="<?=$m->title?>"/></td>
						<td><a href="/index.php/admin/mark/update/<?=$m->id?>"><?=$m->title?></a></td>
						<td><?=$m->description?></td>
						<td><a href="/index.php/admin/model/<?=$m->id?>"><?=$m->modelCount?></a></td>
						<td><?=$m->is_visible ? 'Активен' : 'Скрыт'?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<hr />
			<a class="btn" href="/index.php/admin/mark/create">Добавить марку</a>
		</div>
	</div>
</div>