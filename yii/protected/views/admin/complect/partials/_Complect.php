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
						<td class="td3">
							Описание
						</td>
						<td class="td2">
							Модель
						</td>
						<td class="td1">
							Модификация
						</td>
						<td class="td05">
						 	Цена
						</td>
						<td class="td05">
						 	Статус
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($complect as $compkey => $comp) { ?>
  					<tr>
						<td><?=$comp->id?></td>
						<td><a href="<?=$this->createUrl('admin/updatecomplect',array('id'=>$comp->id))?>"><?=$comp->title?></a></td>
						<td><?=$comp->description?></td>
						<td><a href="<?=$this->createUrl('admin/updatemodel',array('id'=>$comp->model->id))?>"><?=$comp->model->mark->title?> <?=$comp->model->title?></a></td>
						<td><a href="<?=$this->createUrl('admin/updatemodify',array('id'=>$comp->modify->id))?>"><?=$comp->modify->title?></a></td>
						<td><?=$comp->price?></td>
						<td><?=$comp->is_visible ? 'Активен' : 'Скрыт'?></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<hr />
			<a class="btn" href="<?=$this->createUrl('admin/createcomplect')?>">Добавить комплектацию</a>
		</div>
	</div>
</div>