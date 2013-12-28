<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link href="/assets/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <meta name="viewport" content="width=device-width" />

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet"/>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/lib/jquery-2.0.3.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/lib/jquery-ui-1.10.3.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/lib/bootstrap.min.js"></script>

    </head>

    <body>
    	<div class="container-fluid">

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

		</div>
    </body>
</html>