<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Bestlyrics',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@uploads' => 'uploads',
        '@artistas' => 'artistas',
        '@albumes' => 'albumes',
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => false,
            'confirmWithin' => 172800,
            'cost' => 13,
            'admins' => ['admin'],
            'mailer' => [
                'sender'                => ['bestlyricsteam@gmail.com' => 'Bestlyrics'], // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Bienvenido a Bestlyrics',
                'confirmationSubject'   => 'Mensaje de confirmación en Bestlyrics',
                'reconfirmationSubject' => 'Petición de cambio de Email',
                'recoverySubject'       => 'Recuperación de contraseña',
            ],
            'modelMap' => [
                'Profile' => 'app\models\Profile',
                'User' => 'app\models\User',
            ],
            'controllerMap' => [
                'admin' => [
                    'class'  => '\dektrium\user\controllers\AdminController',
                ],
                'registration' => [
                    'class' => \dektrium\user\controllers\RegistrationController::className(),
                    'on ' . \dektrium\user\controllers\RegistrationController::EVENT_AFTER_REGISTER => function ($e) {
                        Yii::$app->response->redirect(['/user/security/login'])->send();
                        Yii::$app->end();
                    }
                ],
                'profile' => 'app\controllers\user\ProfileController',
                'settings' => 'app\controllers\user\AvatarController',
            ],
        ],
        'comment' => [
            'class' => 'yii2mod\comments\Module',
            'controllerMap' => [
                'comments' => 'yii2mod\comments\controllers\ManageController',
            ],
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'AAOliTDg4Kp5BI7zY3-GSBOBzsQvtTeV',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authClientCollection' => [
            'class'   => \yii\authclient\Collection::className(),
            'clients' => [
                // here is the list of clients you want to use
                // you can read more in the "Available clients" section
                'google' => [
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => getenv('GOOGLE_ID'),
                    'clientSecret' => getenv('GOOGLE_SECRET'),
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
                // ...
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
        /*
        'user' => [
            'class' => 'app\components\User',
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        */
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => $params['smtpUsername'],
                'password' => getenv('SMTP_PASS'),
                'port' => '587',
                'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'language' => 'es_ES',
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
