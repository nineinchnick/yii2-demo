<?php
$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
	'id' => 'basic-console',
	'basePath' => dirname(__DIR__),
	'preload' => ['log'],
//	'controllerPath' => dirname(__DIR__) . '/commands',
	'controllerNamespace' => 'app\commands',
	'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
	'aliases' => [
		'@nineinchnick/usr' => '@vendor/nineinchnick/yii2-usr',
		'@nineinchnick/nfy' => '@vendor/nineinchnick/yii2-nfy',
	],
	'modules' => [
		'nfy' => [
			'class' => 'nineinchnick\nfy\Module',
			'queues' => ['mq'],
		],
	],
	'components' => [
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'db' => $db,
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
