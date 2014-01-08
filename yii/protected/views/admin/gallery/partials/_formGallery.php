<?php
/* @var $this AdminController */
/* @var $gallery gallery */
/* @var $form CActiveForm */
?>
<div class="middle-block">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'gallery-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
	        'class'=>'form-horizontal'
	    ),
	)); ?>

		<?php echo $form->errorSummary($gallery); ?>

		<div class="control-group">
			<?php echo $form->labelEx($gallery,'title', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($gallery,'title',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Название')); ?>
				<?php echo $form->error($gallery,'title'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($gallery,'description', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textArea($gallery,'description',array('size'=>50,'maxlength'=>5000, 'placeholder'=>'Описание')); ?>
				<?php echo $form->error($gallery,'description'); ?>
		    </div>
	  	</div>

	  	<div class="control-group">
			<?php echo $form->labelEx($gallery,'is_visible', array('class'=>'control-label')); ?>
		    <div class="controls radio">
		    	<?php echo $form->radioButtonList($gallery,'is_visible',array('1'=>'Отображать','0'=>'Не отображать')); ?>
				<?php echo $form->error($gallery,'is_visible'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton($gallery->isNewRecord ? 'Создать новую галлерею' : 'Сохранить изменения', array('class'=>'btn')); ?>
			</div>
		</div>
		<hr />
		<div class="control-group">
			<div class="controls">
				<?php if(!empty($gallery->id)): ?>
				<a class="btn" href="/index.php/admin/gallery/delete/<?=$gallery->id?>">Удалить запись</a>
				<?php endif; ?>
			</div>
		</div>
		
	<?php $this->endWidget(); ?>
</div>