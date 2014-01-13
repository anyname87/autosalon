<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link href="/assets/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <meta name="viewport" content="width=device-width" />

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet"/>

        <?php Yii::app()->clientScript->registerPackage('fancybox'); ?>
        <?php Yii::app()->clientScript->registerPackage('bootstrap'); ?>
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/index.js"></script>

    </head>

    <body>
    	<div class="container-fluid main-container">
	    	<!-- Строка блоков шапки сайта -->
	    	<div class="row-fluid header-block">
	    		<div class="span1"></div>
	    		<div class="span10">
			        <!-- Шапка сайта включает верхнее меню, главное меню, лого, обратную связь -->
			        <div id="header" class="header">
			        	<div id="logo"></div><!-- logo -->
			        	<div class="clearfix"></div>
			        	<div id="mainmenu">
							<?php $this->widget('zii.widgets.CMenu',array(
								'items'=>array(
									array('label'=>Yii::t('main', 'Главная'), 'url'=>$this->createUrl('site/index')),
									array('label'=>Yii::t('main', 'Каталог'), 'url'=>$this->createUrl('site/catalog')),
									array('label'=>Yii::t('main', 'Online-заявка'), 'url'=>$this->createUrl('site/request')),
									array('label'=>Yii::t('main', 'Новости'), 'url'=>$this->createUrl('site/news')),
									array('label'=>Yii::t('main', 'Контакты'), 'url'=>$this->createUrl('site/contacts')),
									array('label'=>Yii::t('main', 'Административная панель'), 'url'=>$this->createUrl('admin/index'), 'visible'=>!Yii::app()->user->isGuest),
								),
							)); ?>
						</div><!-- mainmenu -->
						<div class="clearfix"></div>
						<?php $this->widget('zii.widgets.CBreadcrumbs', array(
							'links'=>$this->breadcrumbs,
							'homeLink'=>CHtml::link(Yii::t('main', 'Автосалон.РФ'), Yii::app()->homeUrl)
						)); ?><!-- breadcrumbs -->
						<div class="clearfix"></div>
			        </div>
			        <!-- Шапка конец. -->
		        </div>
		        <div class="span1"></div>
		    </div>
		    <!-- Конец строки блоков шапки сайта -->

		    <!-- Строка блоков главного блока -->
		    <div class="row-fluid main-block">
			    <div class="span1"></div>
			    <div class="span10">
			        <!-- Главный блок -->
			        <div id="page" class="main">
			            <?php echo $content; ?>
			        </div>
			        <!-- Главный блок конец. -->
			    </div>
			    <div class="span1"></div>
			</div>
			<!-- Конец строки блоков главного блока -->

			<!-- Строка блоков подвала сайта -->
		    <div class="row-fluid footer-block">
			    <div class="span1"></div>
			    <div class="span10">
			        <!-- Подвал сайта включает нижнее меню, лого и копирайт. -->
			        <div id="footer" class="footer">

			        	<div id="mainmenu">
							<?php $this->widget('zii.widgets.CMenu',array(
								'items'=>array(
									array('label'=>Yii::t('main', 'Главная'), 'url'=>$this->createUrl('site/index')),
									array('label'=>Yii::t('main', 'Каталог'), 'url'=>$this->createUrl('site/catalog')),
									array('label'=>Yii::t('main', 'Online-заявка'), 'url'=>$this->createUrl('site/request')),
									array('label'=>Yii::t('main', 'Новости'), 'url'=>$this->createUrl('site/news')),
									array('label'=>Yii::t('main', 'Контакты'), 'url'=>$this->createUrl('site/contacts')),
									array('label'=>Yii::t('main', 'Административная панель'), 'url'=>$this->createUrl('admin/index'), 'visible'=>!Yii::app()->user->isGuest),
								),
							)); ?>
						</div><!-- mainmenu -->

				        <div class="copyright">
				        	Copyright &copy; <?php echo date('Y'); ?> by Anyname.<br/>
							All Rights Reserved.<br/>
				        </div>
				        <div class="counter">
				        	<?php 
						    	$counter= Configure::model()->findByPk(1);
						    	if(!empty($counter->yandex))
						    		echo $counter->yandex;
								if(!empty($counter->google))
									echo $counter->google;
						    	if(!empty($counter->liveinternet))
						    		echo $counter->liveinternet;
						    ?>
				        </div>
				        <div class="clearfix"></div>
			        </div>
			        <!-- Подвал конец. -->
			    </div>
			    <div class="span1"></div>
			</div>
			<!-- Конец строки блоков подвала сайта -->
		</div>
    </body>
</html>