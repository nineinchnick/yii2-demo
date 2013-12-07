<?php
$params = require(__DIR__ . '/params.php');
$config = [
	'id' => 'basic',
	'name' => 'Basic',
	'basePath' => dirname(__DIR__),
	'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
	'language' => 'pl',
	'sourceLanguage' => 'en-US',
	'aliases' => [
		'@nineinchnick/usr' => '@vendor/nineinchnick/yii2-usr',
	],
	'modules' => [
		'usr' => [
			'class' => 'nineinchnick\usr\Module',
		],
	],
	'components' => [
		'request' => [
			'enableCsrfValidation' => true,
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\User',
			'loginUrl' => ['usr/login'],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'i18n' => [
			'translations' => [
				'models' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'sourceLanguage' => 'en-US',
					'basePath' => '@app/messages',
				],
			],
		],
		'formatter' => [
			'dateFormat' => 'Y-m-d',
			'timeFormat' => 'H:i:s',
			'datetimeFormat' => 'Y-m-d H:i:s',
			'decimalSeparator' => ',',
			'thousandSeparator' => ' ',
		],
		'db' => [
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
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				'usr/<action:(login|logout|reset|recovery|register|profile|password)>'=>'usr/default/<action>',
			],
		],
		'mail' => [
			'class' => 'yii\swiftmailer\Mailer',
			'useFileTransport' => YII_DEBUG,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
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

if (YII_ENV_DEV) {
	$config['preload'][] = 'debug';
	$config['modules']['debug'] = 'yii\debug\Module';
	$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
