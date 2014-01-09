<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Фотографии</h3>
            <?php if(!empty($photo)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td1">
							#
						</td>
						<td class="td2">
							Название
						</td>
						<td class="td4">
							Описание
						</td>
						<td class="td3">
						 	Фотография
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($photo as $pkey => $p) { ?>
  					<tr>
						<td><?=$p->id?></td>
						<td><a href="<?=$this->createUrl('admin/updatephoto',array('id'=>$p->id))?>"><?=$p->title?></a></td>
						<td><?=$p->description?></td>
						<td><a href="<?=$p->src?>"><img src="<?=$p->src?>" alt="<?=$p->title?>"/></a></td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
			<?php if(!empty($gallery_id)): ?>
			<a class="btn" href="<?=$this->createUrl('admin/createphoto',array('id'=>$gallery_id))?>">Добавить фотографию</a>
			<?php else: ?>
			<a class="btn" href="<?=$this->createUrl('admin/createphoto')?>">Добавить фотографию</a>
			<?php endif; ?>
		</div>
	</div>
</div>