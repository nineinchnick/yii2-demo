<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'name' => 'Basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
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
            'loginFormBehaviors' => [
                'oneTimePasswordBehavior' => [
                    'class' => '\nineinchnick\usr\components\OneTimePasswordFormBehavior',
                    'mode' => 'time',
                ],
                'expiredPasswordBehavior' => [
                    'class' => '\nineinchnick\usr\components\ExpiredPasswordBehavior',
                    'passwordTimeout' => 1,
                ],
            ],
            'pictureUploadRules' => [
                ['file', 'skipOnEmpty' => true, 'extensions'=>'jpg, gif, png', 'maxSize'=>2*1024*1024, 'maxFiles' => 1],
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
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'CNsW2fQRoOgyYWSkFDY1uDfxpiPvbC01',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['usr/login'],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOpenId'
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => 'facebook_client_id',
                    'clientSecret' => 'facebook_client_secret',
                ],
            ],
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
            'dateFormat' => 'php:Y-m-d',
            'timeFormat' => 'php:H:i:s',
            'datetimeFormat' => 'php:Y-m-d H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
        ],
        'db' => $db,
        'redis' => [
            'class' => 'yii\redis\Connection',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'usr/<action:(login|logout|reset|recovery|register|profile|profile-picture|password)>'=>'usr/default/<action>',
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
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
