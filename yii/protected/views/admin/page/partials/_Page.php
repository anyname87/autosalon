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
						<td><a href="/index.php/admin/page/update/<?=$p->id?>"><?=$p->title?></a></td>
						<td>список тегов</td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<a class="btn" href="/index.php/admin/page/create">Добавить контент</a>
		</div>
	</div>
</div>