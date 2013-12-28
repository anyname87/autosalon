<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Главная',
);
?>
<?php $this->renderPartial('partials/_Slider', array('mark'=>$mark)); ?>
<div class="clearfix"></div>
<?php $this->renderPartial('partials/_TopBlock', array('action'=>$action)); ?>
<div class="clearfix"></div>
<?php $this->renderPartial('partials/_MiddleBlock'); ?>
<div class="clearfix"></div>
<?php $this->renderPartial('partials/_BottomBlock'); ?>
<div class="clearfix"></div>