<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	Yii::t('main', 'Каталог'),
);
?>
<?php $this->renderPartial('partials/_Marks', array('mark'=>$mark)); ?>
<?php //$this->renderPartial('partials/_Marks'); ?>
<?php //$this->renderPartial('partials/_Catalog'); ?>
<div class="clearfix"></div>