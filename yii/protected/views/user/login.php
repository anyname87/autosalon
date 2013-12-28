<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php
/* @var $this UserController */
/* @var $login LoginForm */
/* @var $form CActiveForm */
?>
<div class="middle-block">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableAjaxValidation'=>true,
			'htmlOptions'=>array(
		        'class'=>'form-horizontal login'
		    ),
		)); ?>

		<div class="control-group">
			<?php echo $form->labelEx($login,'username', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->textField($login,'username',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Login')); ?>
				<?php echo $form->error($login,'username'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<?php echo $form->labelEx($login,'password', array('class'=>'control-label')); ?>
		    <div class="controls">
		    	<?php echo $form->passwordField($login,'password',array('size'=>50,'maxlength'=>50, 'placeholder'=>'Password')); ?>
				<?php echo $form->error($login,'password'); ?>
		    </div>
	  	</div>
	  	<div class="control-group">
			<?php echo $form->label($login,'rememberMe', array('class'=>'control-label'));?>
		    <div class="controls radio">
		    	<?php echo $form->checkBox($login,'rememberMe'); ?>
				<?php echo $form->error($login,'rememberMe'); ?>
		    </div>
	  	</div>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton('Войти', array('class'=>'btn')); ?>
			</div>
		</div>

	<?php $this->endWidget(); ?>
</div>