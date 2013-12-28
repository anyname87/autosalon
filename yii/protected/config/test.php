<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),/*
			'db'=>array(
				'connectionString'=>'sqlite:'.dirname(__FILE__).'/../data/blog-test.db',
			),*/
			// uncomment the following to use a MySQL database
			
			'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=t_auto',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
				'tablePrefix' => 't_',
			),
			
		),
	)
);