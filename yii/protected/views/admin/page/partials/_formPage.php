<?php
/* @var $this AdminController */
/* @var $page Page */
/* @var $form CActiveForm */
?>
<div class="middle-block">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'page-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
	        'class'=>'form-horizontal',
	    ),
	)); ?>

		<?php echo $form->errorSummary($page); ?>

		<div class="control-group">
			<?php echo $form->labelEx($page,'group_page_id', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->dropDownList($page,'group_page_id', $group_page, array('empty'=>'Выберите группу страниц')); ?>
				<?php echo $form->error($page,'group_page_id'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($tag,'name', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($tag,'name', array('placeholder'=>'Введите теги (тег1, тег2, тег3...)')); ?>
		    	<?php echo CHtml::dropDownList('listtags','empty', $tags, array('empty'=>'Выберите теги', 'onChange'=>'SetTag(this, "'.CHtml::activeId($tag,'name').'")')); ?>
				<?php echo $form->error($tag,'name'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($page,'title', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($page,'title',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Название')); ?>
				<?php echo $form->error($page,'title'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($page,'text', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php $this->widget('application.extensions.TheCKEditor.theCKEditorWidget',array(
				    'model'=>$page,               # Data-Model (form model)
				    'attribute'=>'text',          # Attribute in the Data-Model
				    'height'=>'400px',
				    'width'=>'800px',
				    'config' => array('toolbar'=>array(
												        array( 'Font', 'FontSize', 'Undo', 'Redo', '-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'NumberedList', 'BulletedList' ),
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
				<?php echo $form->error($page,'text'); ?>
		    </div>
	  	</div>

	  	<div class="control-group">
			<?php echo $form->labelEx($page,'is_visible', array('class'=>'control-label')); ?>
		    <div class="controls radio">
		    	<?php echo $form->radioButtonList($page,'is_visible',array('1'=>'Отображать','0'=>'Не отображать')); ?>
				<?php echo $form->error($page,'is_visible'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton($page->isNewRecord ? 'Создать новую страницу' : 'Сохранить изменения', array('class'=>'btn')); ?>
			</div>
		</div>
		<hr />
		<div class="control-group">
			<div class="controls">
				<?php if(!empty($page->id)): ?>
				<a class="btn" href="/index.php/admin/page/delete/<?=$page->id?>">Удалить запись</a>
				<?php endif; ?>
			</div>
		</div>
		
	<?php $this->endWidget(); ?>
</div>