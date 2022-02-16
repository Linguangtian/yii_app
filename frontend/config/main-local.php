 <?php
 define('DEFAULT_PAGE_SIZE', 10); // 默认分页大小
 $config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'VGlgOy9tjrvOpsMjg-ccs2jG_XJEoBc7',
        ],
        /*'user'=>[
            'class' => 'frontend\components\Userinfo',
          //  'params' => ['token'],
           // 'enableCsrfValidation' => false,
          //  'identityClass' => 'frontend\components\Userinfo',

        ]*/


    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
