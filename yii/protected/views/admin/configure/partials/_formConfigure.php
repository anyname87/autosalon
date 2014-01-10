<?php
/* @var $this AdminController */
/* @var $configure Mark */
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

		<?php echo $form->errorSummary($configure); ?>

		<div class="control-group">
			<?php echo $form->labelEx($configure,'yandex', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textArea($configure,'yandex',array('size'=>50,'maxlength'=>5000, 'placeholder'=>'Yandex-метрика')); ?>
				<?php echo $form->error($configure,'yandex'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($configure,'google', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textArea($configure,'google',array('size'=>50,'maxlength'=>5000, 'placeholder'=>'Google-аналитика')); ?>
				<?php echo $form->error($configure,'google'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($configure,'liveinternet', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textArea($configure,'liveinternet',array('size'=>50,'maxlength'=>5000, 'placeholder'=>'LiveInternet')); ?>
				<?php echo $form->error($configure,'liveinternet'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton('Сохранить изменения', array('class'=>'btn')); ?>
			</div>
		</div>
		
	<?php $this->endWidget(); ?>
</div>