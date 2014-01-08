<?php
/* @var $this AdminController */
/* @var $model model */
/* @var $form CActiveForm */
?>
<div class="middle-block">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'model-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
	        'class'=>'form-horizontal',
	        'enctype'=>'multipart/form-data'
	    ),
	)); ?>

		<?php echo $form->errorSummary($model); ?>

		<div class="control-group">
			<?php echo $form->labelEx($model,'group_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($model,'group_id', $mark, array(
			    										'empty'=>'Выберите марку',
			    										'ajax'=>array(
												            'type'=>'POST',
												            'url'=>CController::createUrl('/admin/ajaxgetcountmodels'),
												            'data'=>array('id'=>'js:this.value'),
												            'success' => 'function(data){
						                                     	$("#'.CHtml::activeId($model,'priority').'").val(data);
						                                     }',
											        	)
										        	)
										        ); ?>
				<?php echo $form->error($model,'group_id'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Название')); ?>
				<?php echo $form->error($model,'title'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($model,'description', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textArea($model,'description',array('size'=>50,'maxlength'=>5000, 'placeholder'=>'Описание')); ?>
				<?php echo $form->error($model,'description'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($model,'price', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($model,'price',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Стоимость')); ?>
				<?php echo $form->error($model,'price'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($model,'full_img', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php if(!empty($model->full_img)): ?>
		    	<img src="<?=$model->full_img?>" title="<?=$model->title?>" />
		    	<div class="clearfix"></div>
		    	<?php endif; ?>
		    	<?php echo $form->fileField($model,'picture',array('placeholder'=>'Картинка')); ?>
				<?php echo $form->error($model,'picture'); ?>
		    </div>
	  	</div>

	  	<div class="control-group">
			<?php echo $form->labelEx($model,'gallery_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($model,'gallery_id', $gallery, array('empty'=>'Выберите галлерею')); ?>
				<?php echo $form->error($model,'gallery_id'); ?>
		    </div>
	  	</div>

		<?php echo $form->HiddenField($model,'priority', array('value'=>$model->modelCount)); ?>
		<?php echo $form->error($model,'priority'); ?>
		
		<?php echo $form->HiddenField($model,'full_img'); ?>
		<?php echo $form->error($model,'full_img'); ?>

	  	<div class="control-group">
			<?php echo $form->labelEx($model,'is_index_page', array('class'=>'control-label')); ?>
		    <div class="controls radio">
		    	<?php echo $form->radioButtonList($model,'is_index_page',array('1'=>'Отображать','0'=>'Не отображать')); ?>
				<?php echo $form->error($model,'is_index_page'); ?>
		    </div>
	  	</div>
	  	
	  	<div class="control-group">
			<?php echo $form->labelEx($model,'is_visible', array('class'=>'control-label')); ?>
		    <div class="controls radio">
		    	<?php echo $form->radioButtonList($model,'is_visible',array('1'=>'Активный','0'=>'Скрытый')); ?>
				<?php echo $form->error($model,'is_visible'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать новую марку' : 'Сохранить изменения', array('class'=>'btn')); ?>
			</div>
		</div>
		<hr />
		<div class="control-group">
			<div class="controls">
				<?php if(!empty($model->id)): ?>
				<a class="btn" href="/index.php/admin/model/delete/<?=$model->id?>">Удалить запись</a>
				<?php endif; ?>
			</div>
		</div>

	<?php $this->endWidget(); ?>
</div>