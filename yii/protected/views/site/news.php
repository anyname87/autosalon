<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
if(is_array($page)) 
	$this->breadcrumbs=array(
		Yii::t('main', 'Новости') => $this->createUrl('site/news', array('language'=>Yii::app()->language)),
	);
else
	$this->breadcrumbs=array(
		Yii::t('main', 'Новости') => $this->createUrl('site/news', array('language'=>Yii::app()->language)),
		$page->title,
	);
?>
<?php $this->renderPartial('partials/_News', array('page'=>$page, 'pages'=>$pages, 'lastnews'=>$lastnews)); ?>
<div class="clearfix"></div>