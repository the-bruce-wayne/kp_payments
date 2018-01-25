<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-bulkPayments-backOffice',
    'name' => 'Bulk Payments',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            // following line will restrict access to profile, recovery, registration and settings controllers from backend
            'as backend' => 'dektrium\user\filters\BackendFilter',
            'modelMap' => [
                'User' => 'backend\models\User',
            ],
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 86400, // 24 hours in seconds
            'rememberFor' => 1209600, // 2 weeks in seconds
            'recoverWithin' => 21600,// 6 hours in seconds
            'enableConfirmation' => true,
            'enableRegistration' => true,
            'enablePasswordRecovery' => false,
            'enableAccountDelete' => false,
            'adminPermission' => '', // permission for admin route
            'cost' => 12,
            'admins' => ['admin', 'test']
        ],
        //'rbac' => 'dektrium\rbac\RbacWebModule',
        'rbac' => 'dektrium\rbac\Module',
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
            'accessRoles' => null,
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-bulkPayments-backOffice',
        ],
        'user' => [
            //'identityClass' => 'common\models\User',
            //'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-bulkPayments-backOffice', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'bulkPayments-backOffice',
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
