<?php
/* @var $this AdminController */
/* @var $mark Mark */
/* @var $form CActiveForm */
?>
<div class="middle-block">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'mark-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
	        'class'=>'form-horizontal',
	        'enctype'=>'multipart/form-data'
	    ),
	)); ?>

		<?php echo $form->errorSummary($mark); ?>

		<div class="control-group">
			<?php echo $form->labelEx($mark,'title', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($mark,'title',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Название')); ?>
				<?php echo $form->error($mark,'title'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($mark,'description', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textArea($mark,'description',array('size'=>50,'maxlength'=>5000, 'placeholder'=>'Описание')); ?>
				<?php echo $form->error($mark,'description'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($mark,'small_img', array('class'=>'control-label')); ?>
		    <div class="controls">
			    <?php if(!empty($mark->small_img)): ?>
		    	<img src="<?=$mark->small_img?>" title="<?=$mark->title?>" />
		    	<div class="clearfix"></div>
		    	<?php endif; ?>
		    	<?php echo $form->fileField($mark,'icon',array('placeholder'=>'Иконка')); ?>
				<?php echo $form->error($mark,'icon'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($mark,'full_img', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php if(!empty($mark->full_img)): ?>
		    	<img src="<?=$mark->full_img?>" title="<?=$mark->title?>" />
		    	<div class="clearfix"></div>
		    	<?php endif; ?>
		    	<?php echo $form->fileField($mark,'picture',array('placeholder'=>'Картинка')); ?>
				<?php echo $form->error($mark,'picture'); ?>
		    </div>
	  	</div>
	  	<!--
		<div class="control-group">
			<?php echo $form->labelEx($mark,'group_cars_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->listBox($mark,'group_cars_id',array('placeholder'=>'Группа марок')); ?>
				<?php echo $form->error($mark,'group_cars_id'); ?>
		    </div>
	  	</div>
		-->
	  	<div class="control-group">
			<?php echo $form->labelEx($mark,'gallery_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($mark,'gallery_id', $gallery, array('empty'=>'Выберите галлерею')); ?>
				<?php echo $form->error($mark,'gallery_id'); ?>
		    </div>
	  	</div>
		
		<?php echo $form->HiddenField($mark,'priority', array('value'=>$mark->markCount)); ?>
		<?php echo $form->error($mark,'priority'); ?>

		<?php echo $form->HiddenField($mark,'small_img'); ?>
		<?php echo $form->error($mark,'small_img'); ?>
		
		<?php echo $form->HiddenField($mark,'full_img'); ?>
		<?php echo $form->error($mark,'full_img'); ?>

	  	<div class="control-group">
			<?php echo $form->labelEx($mark,'is_visible', array('class'=>'control-label')); ?>
		    <div class="controls radio">
		    	<?php echo $form->radioButtonList($mark,'is_visible',array('1'=>'Активный','0'=>'Скрытый')); ?>
				<?php echo $form->error($mark,'is_visible'); ?>
		    </div>
	  	</div>
	  	
	  	<?php if(is_array($counter)){ 
	  		foreach ($counter as $ckey => $c) { ?>
	  			<div class="control-group">
					<?php echo CHtml::label('Счетчик',$ckey, array('class'=>'control-label')); ?>
				    <div class="controls">
				    	<?php echo $form->dropDownList($c,'id', $counters, array('empty'=>'Без счетчика', 'id'=>$ckey)); ?>
						<?php echo $form->error($c,'id'); ?>
				    </div>
			  	</div>
	  	<?php }}else{ ?>
	  	<div class="control-group">
			<?php echo CHtml::label('Счетчик','id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($counter,'id', $counters, array('empty'=>'Без счетчика')); ?>
				<?php echo $form->error($counter,'id'); ?>
		    </div>
	  	</div>
	  	<?php } ?>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton($mark->isNewRecord ? 'Создать новую марку' : 'Сохранить изменения', array('class'=>'btn')); ?>
			</div>
		</div>
		<hr />
		<div class="control-group">
			<div class="controls">
				<?php if(!empty($mark->id)): ?>
				<a class="btn" href="<?=$this->createUrl('admin/deletemark',array('id'=>$mark->id))?>">Удалить запись</a>
				<?php endif; ?>
			</div>
		</div>
		
	<?php $this->endWidget(); ?>
</div>