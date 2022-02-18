<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
          //  'class' => 'api\components\Request',
           'enableCsrfValidation' => false, //如果防止post跨站攻击
          //  'enableCookieValidation' => true, //防止Cookie攻击
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',  //启动json输入
                'text/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            //'class' => 'api\components\Userinfo',
            //'params' => ['token'],
          //  'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
          /*  'identityClass' => 'api\components\Userinfo',
            'enableAutoLogin' => true,
           'enableSession'=>false,
            'loginUrl'=>false*/
/*
                'class'  => 'api\services\UserService',
                'params' => ['token'],*/
            'identityClass' => 'api\services\UserService',
            'enableAutoLogin' => true,
            'enableSession' => false,
            'loginUrl' => null,



        ],
      /*  'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
        ],*/

        'websocket' => [
            'class' => '\yiiplus\websocket\<dirver>\WebSocket',
            'host' => '127.0.0.1',
            'port' => 9501,
            'channels' => [
                'push-message' => '\api\components\PushMessageChannel', // 配置 channel 对应的执行类
            ],
        ],



        // 缓存
     /*   'cache' => array(
            'class' => 'A cache class, like: system.caching.CApcCache',
        ),
        'session' => array( //  memcache session cache
            'class' => 'CCacheHttpSession',
            'autoStart' => 1,
            'sessionName' => 'frontend',
            'cookieParams' => array('lifetime' => '3600', 'path' => '/', 'domain' => '.test.com', 'httponly' => '1'),
            'cookieMode' => 'only',
        ),*/


        'response' => [
            'class' => 'api\components\Response',
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
            'errorAction' => 'site/error',   //异常和错误处理配置
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,  //开启严格解析,必须要有rule才可以访问
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',  //引用得url api规则
                    'controller' => 'user',

                    'except'=>[],
                    //'only'=>[], 只能执行得
                    //'Pluralize'=>false 禁用资源复数形式, 只能用user/index
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'book',
                ] ,//api 规则
                [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'site',
                ], //api
                 [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'book2',

                ] //api
            ],
        ],

    ],
    'params' => $params,



    // 应用的名字
    // 使用 Yii::app()->name 来访问
   // 'name' => 'My website',



    //维护程序时，这样子所有的请求转发到一个地方
    //'catchAllRequest' => array('site/all'),


//如何在应用程序处理请求之前执行一段操作？当然这个function方法要存在index.php
    //'onBeginRequest' => 'function',



    // 默认的 controller
   // 'defaultController' => 'site',



    // 自动载入的类
    /*'import' => array(
        'application.models.*',
        'application.components.*',
    ),*/




];
