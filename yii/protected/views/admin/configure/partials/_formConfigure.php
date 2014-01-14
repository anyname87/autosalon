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
			<?php echo $form->labelEx($configure,'yandex_map', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textArea($configure,'yandex_map',array('size'=>50,'maxlength'=>5000, 'placeholder'=>'Yandex-map')); ?>
				<?php echo $form->error($configure,'yandex_map'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($configure,'header', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php $this->widget('application.extensions.TheCKEditor.TheCKEditorWidget',array(
				    'model'=>$configure,               # Data-Model (form model)
				    'attribute'=>'header',          # Attribute in the Data-Model
				    'height'=>'200px',
				    'width'=>'600px',
				    'config' => array('toolbar'=>array(
												        array( 'Font', 'FontSize', 'TextColor', 'Undo', 'Redo', '-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'JustifyLeft','JustifyCenter','JustifyRight', '-', 'NumberedList', 'BulletedList' ),
												        array( 'Image', 'Link', 'Unlink', 'Anchor' ),
												        array( 'Source'),
												     ),
									  'filebrowserImageUploadUrl' => Yii::app()->baseUrl . '/ckeditor/filemanager/upload.php',
									  'filebrowserBrowseUrl' => Yii::app()->baseUrl . '/ckeditor/filemanager/browse.php',
									  'filebrowserImageBrowseUrl' => Yii::app()->baseUrl . '/ckeditor/filemanager/browse.php',
									  'filebrowserFlashBrowseUrl' => Yii::app()->baseUrl . '/ckeditor/filemanager/browse.php',
				    ),
				    'toolbarSet'=>'Basic',          # EXISTING(!) Toolbar (see: ckeditor.js)
				    'ckeditor'=>Yii::app()->basePath.'/../ckeditor/ckeditor.php',
				                                    # Path to ckeditor.php
				    'ckBasePath'=>Yii::app()->baseUrl.'/ckeditor/',
				                                    # Relative Path to the Editor (from Web-Root)
				    'css' => Yii::app()->baseUrl.'/css/index.css',
				                                    # Additional Parameters
				) );  ?>
				<?php echo $form->error($configure,'header'); ?>
		    </div>
	  	</div>


		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton('Сохранить изменения', array('class'=>'btn')); ?>
			</div>
		</div>
		
	<?php $this->endWidget(); ?>
</div>