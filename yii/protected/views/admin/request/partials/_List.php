<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Список заявок</h3>
            <?php if(!empty($request)): ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<td class="td1">
							#
						</td>
						<td class="td3">
							От кого
						</td>
						<td class="td2">
							Телефон
						</td>
						<td class="td2">
							Дата создания
						</td>
						<td class="td2">
							Пометить
						</td>
					</tr>
				</thead>
  				<tbody>
  					<?php foreach ($request as $rkey => $r) { ?>
  					<tr>
						<td><?=$r->id?></td>
						<td><?=CHtml::link($r->name, array('admin/request', 'id'=>$r->id, 'language'=>Yii::app()->language))?></td>
						<td><?=$r->phone?></td>
						<td><?=$r->create_date?></td>
						<td>
							<?php echo CActiveForm::dropDownList($r,'group_request_id', $group_request, 
																  	array(
																		'ajax'=>array(
																            'type'=>'POST',
																            'url'=>CController::createUrl('admin/ajaxsetstatusrequest'),
																            'data'=>array('id'=>$r->id, 'status'=>'js:this.value'),
															        	)
														        	)
														        ); ?>
						</td>
					</tr>
  					<?php } ?>
  				</tbody>
			</table>
			<?php endif; ?>
		</div>
	</div>
</div>