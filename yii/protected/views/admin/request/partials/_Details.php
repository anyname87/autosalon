<div class="middle-block">
	<div class="text-block">
		<div class="paragraph">
            <h3>Детальное описание заявки</h3>
            <?php if(!empty($request)): ?>
            	<h4><?=$request->getAttributeLabel('name')?></h4>
            	<span><?=$request->name?></span>
            	<h4><?=$request->getAttributeLabel('phone')?></h4>
            	<span><?=$request->phone?></span>
            	<h4><?=$request->getAttributeLabel('mark_id')?></h4>
            	<span><?=$request->mark->title?></span>
            	<h4><?=$request->getAttributeLabel('model_id')?></h4>
            	<span><?=$request->model->title?></span>
            	<h4><?=$request->getAttributeLabel('compl')?></h4>
            	<span><?=$request->compl?></span>
            	<h4><?=$request->getAttributeLabel('city_id')?></h4>
            	<span><?=$request->city->title?></span>
            	<h4><?=$request->getAttributeLabel('work_name')?></h4>
            	<span><?=$request->work_name?></span>
            	<h4><?=$request->getAttributeLabel('experience')?></h4>
            	<span><?=$request->experience?></span>
            	<hr />
            	<?php echo CActiveForm::dropDownList($request,'group_request_id', $group_request, 
																  	array(
																		'ajax'=>array(
																            'type'=>'POST',
																            'url'=>CController::createUrl('admin/ajaxsetstatusrequest'),
																            'data'=>array('id'=>$request->id, 'status'=>'js:this.value'),
															        	)
														        	)
														        ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>