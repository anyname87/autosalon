<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	Yii::t('main', 'Каталог') => $this->createUrl('site/catalog', array('language'=>Yii::app()->language)),
	empty($model) ? 'Не найден':$model->title,
);
?>
<?php $this->renderPartial('partials/_Detail', array('model'=>$model)); ?>
<div class="clearfix"></div>