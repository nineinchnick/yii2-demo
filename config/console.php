<?php
$params = require(__DIR__ . '/params.php');
return [
	'id' => 'basic-console',
	'basePath' => dirname(__DIR__),
	'preload' => ['log'],
	'controllerPath' => dirname(__DIR__) . '/commands',
	'controllerNamespace' => 'app\commands',
	'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'sqlite:'.dirname(__FILE__).'/../data/database.db',
			'tablePrefix' => '',
			'charset' => 'utf8',
			'on '.yii\db\Connection::EVENT_AFTER_OPEN => function(){Yii::$app->db->createCommand('PRAGMA foreign_keys = ON')->execute();},
		],
		'log' => [
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
	],
	'params' => $params,
];
