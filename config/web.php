<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
	'id' => 'basic',
	'name' => 'Basic',
	'basePath' => dirname(__DIR__),
	'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
	'language' => 'pl',
	'sourceLanguage' => 'en-US',
	'aliases' => [
		'@nineinchnick/usr' => '@vendor/nineinchnick/yii2-usr',
		'@nineinchnick/nfy' => '@vendor/nineinchnick/yii2-nfy',
	],
	'modules' => [
		'usr' => [
			'class' => 'nineinchnick\usr\Module',
			'captcha' => true,
			'oneTimePasswordMode' => 'time',
			'passwordTimeout' => 1,
			'pictureUploadRules' => [
				['file', 'skipOnEmpty' => true, 'types'=>'jpg, gif, png', 'maxSize'=>2*1024*1024, 'maxFiles' => 1],
			],
		],
		'nfy' => [
			'class' => 'nineinchnick\nfy\Module',
			'queues' => ['dbmq','rmq'],
		],
	],
	'as applicationConfig' => [
		'class' => 'app\components\ApplicationConfigBehavior',
	],
	'components' => [
		 'session' => [
			'class' => 'yii\web\DbSession',
			'sessionTable' => '{{%session}}',
		],
		'request' => [
			'enableCsrfValidation' => true,
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
			'loginUrl' => ['usr/login'],
		],
		'dbmq' => [
			'class' => 'nineinchnick\nfy\components\DbQueue',
			'id' => 'dbmq',
			'label' => 'Db Queue',
		],
		'rmq' => [
			'class' => 'nineinchnick\nfy\components\RedisQueue',
			'id' => 'rmq',
			'label' => 'Redis Queue',
		],
		'smq' => [
			'class' => 'nineinchnick\nfy\components\SysVQueue',
			'id' => 'a',
			'label' => 'SysV Queue',
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
		'db' => $db,
		'redis' => [
			'class' => 'yii\redis\Connection',
		],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
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
			'messageConfig' => [
				'from' => 'admin@demo2.niix.pl',
			],
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['profile', 'trace', 'error', 'warning', 'info'],
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
