<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'АВТОСАЛОН.РФ',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
	'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'052110',
        ),
    ),
	'defaultController'=>'site',

	// application components
	'components'=>array(
		'user'=>array(
			'loginUrl'=>array('user/login'),
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=a_auto',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'a_',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'/catalog'=>'site/catalog',
				'catalog/<id:\d+>/'=>'site/detail',
				'/request'=>'site/request',
				'/contacts'=>'site/contacts',
				'/news'=>'site/news',
				'/news/<id:\d+>'=>'site/news',
				'/ajaxgetmodels'=>'site/ajaxgetmodels',
				'/ajaxgetcountmodels'=>'site/ajaxgetcountmodels',
				'/ajaxgetcomplects'=>'site/ajaxgetcomplects',
				'/ajaxsetstatusrequest'=>'admin/ajaxsetstatusrequest',
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'/admin'=>'admin/index',
				'/admin/request'=>'admin/request',
				'/admin/request/<id:\d+>'=>'admin/request',
				'/admin/model'=>'admin/model',
				'/admin/model/<id:\d+>'=>'admin/model',
				'/admin/model/create/<id:\d+>'=>'admin/createmodel',
				'/admin/model/update/<id:\d+>'=>'admin/updatemodel',
				'/admin/model/create'=>'admin/createmodel',
				'/admin/model/update'=>'admin/updatemodel',
				'/admin/mark/create'=>'admin/createmark',
				'/admin/mark/update/<id:\d+>'=>'admin/updatemark',
				'/admin/gallery/create'=>'admin/creategallery',
				'/admin/photo/<id:\d+>'=>'admin/photo',
				'/admin/photo/create/<id:\d+>'=>'admin/createphoto',
				'/admin/modify'=>'admin/modify',
				'/admin/modify/create'=>'admin/createmodify',
				'/admin/modify/update/<id:\d+>'=>'admin/updatemodify',
				'/admin/complect'=>'admin/complect',
				'/admin/complect/create'=>'admin/createcomplect',
				'/admin/complect/update/<id:\d+>'=>'admin/updatecomplect',
				'/admin/page'=>'admin/page',
				'/admin/page/<id:\d+>'=>'admin/page',
				'/admin/page/create'=>'admin/createpage',
				'/admin/ckupload'=>'admin/ckupload',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
			'clientScript'=>array(
	    'packages' => array(
	       // Уникальное имя пакета
	       'fancybox' => array(
	            // Где искать подключаемые файлы js
	            'baseUrl' => '/js//',
	            'js'=>array('jquery.fancybox.js', 'jquery.fancybox.pack.js'),
	            // Подключает файл css
	            'css' => array('fancybox/jquery.fancybox.css'),
	            // Зависимость от другого пакета
	            'depends'=>array('jquery'),
	        ),
	       	// Уникальное имя пакета
	       'bootstrap' => array(
	            // Где искать подключаемые файлы js
	            'baseUrl' => '/js//',
	            'js'=>array('bootstrap.min.js'),
	            // Подключает файл css
	            'css' => array('bootstrap.min.css'),
	            // Зависимость от другого пакета
	            'depends'=>array('jquery'),
	        ),
	    )
	),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);