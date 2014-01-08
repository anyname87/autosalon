<?php
/* @var $this AdminController */
/* @var $photo Photo */
/* @var $form CActiveForm */
?>
<div class="middle-block">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'photo-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
	        'class'=>'form-horizontal',
	        'enctype'=>'multipart/form-data'
	    ),
	)); ?>

		<?php echo $form->errorSummary($photo); ?>

		<div class="control-group">
			<?php echo $form->labelEx($photo,'title', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($photo,'title',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Название')); ?>
				<?php echo $form->error($photo,'title'); ?>
		    </div>
	  	</div>
	  	
	  	<div class="control-group">
			<?php echo $form->labelEx($photo,'gallery_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($photo,'gallery_id', $gallery, array('empty'=>'Выберите галлерею')); ?>
				<?php echo $form->error($photo,'gallery_id'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($photo,'description', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textArea($photo,'description',array('size'=>50,'maxlength'=>5000, 'placeholder'=>'Описание')); ?>
				<?php echo $form->error($photo,'description'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($photo,'src', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php if(!empty($photo->src)): ?>
		    	<img src="<?=$photo->src?>" title="<?=$photo->title?>" />
		    	<?php endif; ?>
		    	<div class="clearfix"></div>
		    	<?php echo $form->fileField($photo,'picture',array('placeholder'=>'Картинка')); ?>
				<?php echo $form->error($photo,'picture'); ?>
		    </div>
	  	</div>

		<?php echo $form->HiddenField($photo,'src',array('value'=>' ')); ?>
		<?php echo $form->error($photo,'src'); ?>

	  	<div class="control-group">
			<?php echo $form->labelEx($photo,'is_visible', array('class'=>'control-label')); ?>
		    <div class="controls radio">
		    	<?php echo $form->radioButtonList($photo,'is_visible',array('1'=>'Отображать','0'=>'Не отображать')); ?>
				<?php echo $form->error($photo,'is_visible'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton($photo->isNewRecord ? 'Создать новое фото' : 'Сохранить изменения', array('class'=>'btn')); ?>
			</div>
		</div>
		<hr />
		<div class="control-group">
			<div class="controls">
				<?php if(!empty($photo->id)): ?>
				<a class="btn" href="/index.php/admin/photo/delete/<?=$photo->id?>">Удалить запись</a>
				<?php endif; ?>
			</div>
		</div>
		
	<?php $this->endWidget(); ?>
</div>