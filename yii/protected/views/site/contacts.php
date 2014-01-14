<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	Yii::t('main', 'Контакты'),
);
?>
<?php $this->renderPartial('partials/_Contacts', array('page'=>$page, 'yandex_map'=>$yandex_map)); ?>
<div class="clearfix"></div>