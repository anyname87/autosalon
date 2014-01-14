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
			        	<?php $configure= Configure::model()->findByPk(1); ?>
			        	<div id="logo"></div><!-- logo -->
			        	<div class="header-control">
			        		<?php $this->widget('application.components.widgets.LanguageSelector');?>
			        	</div>
			        	
			        	<div class="header-content">
				        	<?php if(!empty($configure->header))
							    	echo $configure->header;?>
			        	</div>
			        	<div class="clearfix"></div>
			        	<div id="mainmenu">
							<?php $this->widget('zii.widgets.CMenu',array(
								'items'=>array(
									array('label'=>Yii::t('main', 'Главная'), 'url'=>$this->createUrl('site/index', array('language'=>Yii::app()->language))),
									array('label'=>Yii::t('main', 'Каталог'), 'url'=>$this->createUrl('site/catalog', array('language'=>Yii::app()->language))),
									array('label'=>Yii::t('main', 'Online-заявка'), 'url'=>$this->createUrl('site/request', array('language'=>Yii::app()->language))),
									array('label'=>Yii::t('main', 'Новости'), 'url'=>$this->createUrl('site/news', array('language'=>Yii::app()->language))),
									array('label'=>Yii::t('main', 'Контакты'), 'url'=>$this->createUrl('site/contacts', array('language'=>Yii::app()->language))),
									array('label'=>Yii::t('main', 'Административная панель'), 'url'=>$this->createUrl('admin/index', array('language'=>Yii::app()->language)), 'visible'=>!Yii::app()->user->isGuest),
								),
							)); ?>
						</div><!-- mainmenu -->
						<div class="clearfix"></div>
						<?php $this->widget('zii.widgets.CBreadcrumbs', array(
							'links'=>$this->breadcrumbs,
							'homeLink'=>CHtml::link(Yii::t('main', 'Автосалон.РФ'), $this->createUrl('site/index', array('language'=>Yii::app()->language)))
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
									array('label'=>Yii::t('main', 'Главная'), 'url'=>$this->createUrl('site/index', array('language'=>Yii::app()->language))),
									array('label'=>Yii::t('main', 'Каталог'), 'url'=>$this->createUrl('site/catalog', array('language'=>Yii::app()->language))),
									array('label'=>Yii::t('main', 'Online-заявка'), 'url'=>$this->createUrl('site/request', array('language'=>Yii::app()->language))),
									array('label'=>Yii::t('main', 'Новости'), 'url'=>$this->createUrl('site/news', array('language'=>Yii::app()->language))),
									array('label'=>Yii::t('main', 'Контакты'), 'url'=>$this->createUrl('site/contacts', array('language'=>Yii::app()->language))),
									array('label'=>Yii::t('main', 'Административная панель'), 'url'=>$this->createUrl('admin/index', array('language'=>Yii::app()->language)), 'visible'=>!Yii::app()->user->isGuest),
								),
							)); ?>
						</div><!-- mainmenu -->

				        <div class="copyright">
				        	<?=Yii::app()->params->copyrightInfo?>
				        </div>
				        <div class="counter">
				        	<?php 
						    	if(!empty($configure->yandex))
						    		echo $configure->yandex;
								if(!empty($configure->google))
									echo $configure->google;
						    	if(!empty($configure->liveinternet))
						    		echo $configure->liveinternet;
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