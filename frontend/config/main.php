<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-bulkPayments',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            // following line will restrict access to admin controller from frontend application
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
            'class' => 'dektrium\user\Module',
            'modelMap' => [
                'User' => 'frontend\models\User',
                'RegistrationForm' => 'frontend\models\RegistrationForm',
            ],
            'confirmWithin' => 86400, // 24 hours in seconds
            'rememberFor' => 1209600, // 2 weeks in seconds
            'recoverWithin' => 21600,// 6 hours in seconds
            'enableUnconfirmedLogin' => true,
            'enableFlashMessages' => false,
            'enableConfirmation' => true,
            'enableRegistration' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'enablePasswordRecovery' => true,
            'enableAccountDelete' => false,
            'emailChangeStrategy' => (\dektrium\user\Module::STRATEGY_SECURE),
            'admins' => ['admin', 'test'],
        ],
        //'rbac' => 'dektrium\rbac\RbacWebModule',
        'rbac' => 'dektrium\rbac\Module',
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-bulkPayments',
        ],
        'user' => [
            //'identityClass' => 'common\models\User',
            //'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-bulkPayments', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'bulkPayments',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
