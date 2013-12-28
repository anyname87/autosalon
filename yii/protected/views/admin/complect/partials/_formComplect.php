<?php
/* @var $this AdminController */
/* @var $complect Complect */
/* @var $form CActiveForm */
?>
<div class="middle-block">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'complect-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
	        'class'=>'form-horizontal',
	        'enctype'=>'multipart/form-data'
	    ),
	)); ?>

		<?php echo $form->errorSummary($complect); ?>

		<div class="control-group">
			<?php echo $form->labelEx($complect,'model_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($complect,'model_id', $model, array('empty'=>'Выберите модель')); ?>
				<?php echo $form->error($complect,'group_id'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($complect,'modify_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($complect,'modify_id', $modify, array('empty'=>'Выберите модификацию')); ?>
				<?php echo $form->error($complect,'modify_id'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($complect,'title', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($complect,'title',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Название')); ?>
				<?php echo $form->error($complect,'title'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($complect,'description', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textArea($complect,'description',array('size'=>50,'maxlength'=>5000, 'placeholder'=>'Описание')); ?>
				<?php echo $form->error($complect,'description'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($complect,'price', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($complect,'price',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Цена')); ?>
				<?php echo $form->error($complect,'price'); ?>
		    </div>
	  	</div>

	  	<div class="control-group">
			<?php echo $form->labelEx($complect,'is_visible', array('class'=>'control-label')); ?>
		    <div class="controls radio">
		    	<?php echo $form->radioButtonList($complect,'is_visible',array('1'=>'Отображать','0'=>'Не отображать')); ?>
				<?php echo $form->error($complect,'is_visible'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton($complect->isNewRecord ? 'Создать новую марку' : 'Сохранить изменения', array('class'=>'btn')); ?>
			</div>
		</div>

	<?php $this->endWidget(); ?>
</div>