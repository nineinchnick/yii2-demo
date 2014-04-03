<?php

return [			
    /*'class' => 'yii\db\Connection',
	'dsn'	=> 'pgsql:host=localhost;dbname=',
	'username'			=> '',
	'password'			=> '',
	'tablePrefix' => 'c_',
	'charset' => 'utf8',*/
	/*'on '.yii\db\Connection::EVENT_AFTER_OPEN => function(){Yii::$app->db->createCommand('SET search_path TO bank,public')->execute();},*/
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:'.dirname(__FILE__).'/../data/database.db',
    'tablePrefix' => '',
    'charset' => 'utf8',
    'on '.yii\db\Connection::EVENT_AFTER_OPEN => function(){Yii::$app->db->createCommand('PRAGMA foreign_keys = ON')->execute();},
];
