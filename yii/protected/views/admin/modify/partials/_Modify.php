<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Модификации авто</h3>
            <?php if(!empty($modify)): ?>
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
						 	Комплектации
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($modify as $modkey => $mod) { ?>
  					<tr>
						<td><?=$mod->id?></td>
						<td><a href="/index.php/admin/modify/update/<?=$mod->id?>"><?=$mod->title?></a></td>
						<td><?=$mod->description?></td>
						<td><a href="/index.php/admin/complect/<?=$mod->id?>"><?=$mod->complectCount?></a></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<a class="btn" href="/index.php/admin/modify/create">Добавить модификацию</a>
		</div>
	</div>
</div>