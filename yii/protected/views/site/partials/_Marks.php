<?php if(!empty($mark)): ?>
	<?php for($i=0; $i<sizeof($mark);$i++): ?>
	<table class="item-table">
		<thead>
			<tr>
				<?php for($j=$i;$j<$i+4;$j++): ?>
					<?php if(!empty($mark[$j])): ?>	
					<td>
						<img src="<?=$mark[$j]->full_img?>" alt="<?=$mark[$j]->title?>">
		        		<h2><?=$mark[$j]->title?></h2>
					</td>
					<?php endif; ?>
				<?php endfor; ?>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php for($j=$i;$j<$i+4;$j++): ?>
					<td>			
						<?php if(!empty($mark[$j])): ?>	
							<?php $model= $mark[$j]->model; ?>
							<?php if(!empty($model)): ?>
								<ul>
								<?php foreach ($model as $mkey => $m){ ?>
									<li>
										<img class="eye" src="/css/images/eye.png" alt="eye" data-original-title="<img src='<?=$m->full_img?>' alt='<?=$m->title?>' />" />
										<a href="<?=$this->createUrl('site/detail',array('id'=>$m->id))?>"><?=$m->title?></a>
									</li>
								<?php } ?>
								</ul>
							<?php else: ?>
								<ul>
									<li>
										<img class="eye" src="/css/images/eye.png" alt="eye" /><a href="javascript:void(0);">Нет в наличии</a>
									</li>
								</ul>
							<?php endif; ?>
						<?php endif; ?>
					</td>
				<?php endfor; ?>
			</tr>
		</tbody>
	</table>
	<?php $i=$i+3; ?>
	<?php endfor; ?>
<?php endif; ?>