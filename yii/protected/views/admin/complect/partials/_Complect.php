<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Комплектация авто</h3>
            <?php if(!empty($complect)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td1">
							#
						</td>
						<td class="td2">
							Название
						</td>
						<td class="td6">
							Описание
						</td>
						<td class="td1">
						 	Цена
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($complect as $compkey => $comp) { ?>
  					<tr>
						<td><?=$comp->id?></td>
						<td><a href="/index.php/admin/complect/update/<?=$comp->id?>"><?=$comp->title?></a></td>
						<td><?=$comp->description?></td>
						<td><?=$comp->price?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<a class="btn" href="/index.php/admin/complect/create">Добавить модификацию</a>
		</div>
	</div>
</div>