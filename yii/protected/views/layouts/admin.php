<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link href="/assets/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <meta name="viewport" content="width=device-width" />
        
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css" rel="stylesheet"/>
        
        <?php Yii::app()->clientScript->registerPackage('fancybox'); ?>
        <?php Yii::app()->clientScript->registerPackage('bootstrap'); ?>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/index.js"></script>

    </head>

    <body>
    	<div class="container-fluid">
	    	<!-- Строка блоков шапки сайта -->
	    	<div class="row-fluid header-block">
	    		<div class="span1"></div>
	    		<div class="span10">
			        <!-- Шапка сайта включает лого, кнопку Справочник и кнопку Выйти -->
			        <div id="header" class="header">
			        	<div id="logo"></div><!-- logo -->
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
			        	<div id="leftmenu">
							<?php $this->widget('zii.widgets.CMenu',array(
								'items'=>array(
									array('label'=>Yii::t('main', 'Главная'), 'url'=>array('admin/')),

									array('label'=>Yii::t('main', 'Автомобили'), 'items'=>array(
							            array('label'=>Yii::t('main', 'Марки'), 'url'=>array('admin/mark')),
							            array('label'=>Yii::t('main', 'Модели'), 'url'=>array('admin/model')),
							            array('label'=>Yii::t('main', 'Модификации'), 'url'=>array('admin/modify')),
							            array('label'=>Yii::t('main', 'Комплектации'), 'url'=>array('admin/complect')),
							        )),

									array('label'=>Yii::t('main', 'Обратная связь'), 'items'=>array(
							            array('label'=>Yii::t('main', 'Заявки'), 'url'=>array('admin/request')),
							            array('label'=>Yii::t('main', 'Отзывы'), 'url'=>array('admin/mention')),
							            array('label'=>Yii::t('main', 'Комментарии'), 'url'=>array('admin/comment')),
							        )),

									array('label'=>Yii::t('main', 'Контент'), 'items'=>array(
							            array('label'=>Yii::t('main', 'Тексты'), 'url'=>array('admin/page')),
							            array('label'=>Yii::t('main', 'Галлереи'), 'url'=>array('admin/gallery')),
							        )),

									array('label'=>Yii::t('main', 'Настройки'), 'items'=>array(
							            array('label'=>Yii::t('main', 'Основные'), 'url'=>array('admin/configure')),
							            array('label'=>Yii::t('main', 'Пользовательские'), 'url'=>array('admin/user')),
							        )),
									/*
									array('label'=>'Акции', 'url'=>array('admin/action'), 'items'=>array(
							            array('label'=>'Новости', 'url'=>array('admin/action/news', 'tag'=>'news')),
							            array('label'=>'Добавить Акцию', 'url'=>array('admin/action/add', 'tag'=>'add')),
							        ))*/
								),
							)); ?>
						</div><!-- leftmenu -->
			            <?php echo $content; ?>
			        </div>
			        <!-- Главный блок конец. -->
			        <div class="clearfix"></div>
			    </div>
			    <div class="span1"></div>
			</div>
			<!-- Конец строки блоков главного блока -->
			
			<!-- Строка блоков подвала сайта -->
		    <div class="row-fluid footer-block">
			    <div class="span1"></div>
			    <div class="span10">
			        <!-- Подвал сайта включает копирайт. -->
			        <div id="footer" class="footer">
				        <div class="copyright">
				        	Copyright &copy; <?php echo date('Y'); ?> by Anyname.<br/>
							All Rights Reserved.<br/>
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