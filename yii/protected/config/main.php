<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'АВТОСАЛОН.РФ',
    
    'sourceLanguage' => 'ru',
    'language' => 'en',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.CAdvancedArBehavior',
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
			'showScriptName'=>false,
			'rules'=>array(
				'<language:(ru|en)>/catalog/<id:\d+>'=>'site/detail',
				'<language:(ru|en)>/<controller:\w+>/complect/0/<model:\d+>'=>'<controller>/complect',
				'/ajaxsetstatusrequest'=>'admin/ajaxsetstatusrequest',
				'<language:(ru|en)>/admin'=>'admin/index',
				'<language:(ru|en)>/<action:\w+>/<id:\d+>'=>'site/<action>',
				'<language:(ru|en)>/<action:\w+>'=>'site/<action>',
				'<language:(ru|en)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<language:(ru|en)>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<language:(ru|en)>/<controller:\w+>'=>'<controller>/index',	
				/*'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',*/
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