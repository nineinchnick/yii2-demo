<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii', 'usr'],
//	'controllerPath' => dirname(__DIR__) . '/commands',
    'controllerNamespace' => 'app\commands',
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'aliases' => [
        '@nineinchnick/usr' => '@vendor/nineinchnick/yii2-usr',
        '@nineinchnick/nfy' => '@vendor/nineinchnick/yii2-nfy',
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
        'usr' => [
            'class' => 'nineinchnick\usr\Module',
            'captcha' => true,
            'oneTimePasswordMode' => 'time',
            'passwordTimeout' => 1,
            'pictureUploadRules' => [
                ['file', 'skipOnEmpty' => true, 'extensions'=>'jpg, gif, png', 'maxSize'=>2*1024*1024, 'maxFiles' => 1],
            ],
        ],
        'nfy' => [
            'class' => 'nineinchnick\nfy\Module',
            'queues' => ['dbmq', 'rmq'],
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
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => YII_DEBUG,
            'messageConfig' => [
                'from' => 'admin@demo2.niix.pl',
            ],
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
