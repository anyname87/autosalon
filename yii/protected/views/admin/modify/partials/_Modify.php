<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Модификации авто</h3>
            <?php if(!empty($modify)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td05">
							#
						</td>
						<td class="td2">
							Название
						</td>
						<td class="td6">
							Описание
						</td>
						<td class="td1">
						 	Комп.
						</td>
						<td class="td05">
						 	Статус
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($modify as $modkey => $mod) { ?>
  					<tr>
						<td><?=$mod->id?></td>
						<td><a href="<?=$this->createUrl('admin/updatemodify',array('id'=>$mod->id))?>"><?=$mod->title?></a></td>
						<td><?=$mod->description?></td>
						<td><a href="<?=$this->createUrl('admin/complect',array('id'=>$mod->id))?>"><?=$mod->complectCount?></a></td>
						<td><?=$mod->is_visible ? 'Активен' : 'Скрыт'?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<hr />
			<a class="btn" href="<?=$this->createUrl('admin/createmodify')?>">Добавить модификацию</a>
		</div>
	</div>
</div>