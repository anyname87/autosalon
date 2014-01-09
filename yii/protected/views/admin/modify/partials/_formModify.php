<?php
/* @var $this AdminController */
/* @var $modify Mark */
/* @var $form CActiveForm */
?>
<div class="middle-block">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'modify-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
	        'class'=>'form-horizontal',
	        'enctype'=>'multipart/form-data'
	    ),
	)); ?>

		<?php echo $form->errorSummary($modify); ?>

		<div class="control-group">
			<?php echo $form->labelEx($modify,'title', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($modify,'title',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Название')); ?>
				<?php echo $form->error($modify,'title'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($modify,'description', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textArea($modify,'description',array('size'=>50,'maxlength'=>5000, 'placeholder'=>'Описание')); ?>
				<?php echo $form->error($modify,'description'); ?>
		    </div>
	  	</div>

	  	<div class="control-group">
			<?php echo $form->labelEx($modify,'is_visible', array('class'=>'control-label')); ?>
		    <div class="controls radio">
		    	<?php echo $form->radioButtonList($modify,'is_visible',array('1'=>'Активный','0'=>'Скрытый')); ?>
				<?php echo $form->error($modify,'is_visible'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton($modify->isNewRecord ? 'Создать новую модификацию' : 'Сохранить изменения', array('class'=>'btn')); ?>
			</div>
		</div>
		<hr />
		<div class="control-group">
			<div class="controls">
				<?php if(!empty($modify->id)): ?>
				<a class="btn" href="<?=$this->createUrl('admin/deletemodify',array('id'=>$modify->id))?>">Удалить запись</a>
				<?php endif; ?>
			</div>
		</div>
		
	<?php $this->endWidget(); ?>
</div>