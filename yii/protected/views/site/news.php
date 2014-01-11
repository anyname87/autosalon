<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Новости',
);
?>
<?php $this->renderPartial('partials/_News', array('page'=>$page, 'pages'=>$pages, 'lastnews'=>$lastnews)); ?>
<div class="clearfix"></div>