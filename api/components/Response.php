<?php
namespace api\components;

/*
*前端响应类处理
*
* */


use api\helpers\ErrorCode;
use Codeception\Util\Debug;

class Response extends \yii\web\Response{

    /**
     * 定义返回的格式位json
     */
    public $format = self::FORMAT_JSON;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        //事件注入  \yii\web\response.php 336行   有预留了触发位置  public function send() $this->trigger(self::EVENT_BEFORE_SEND);
        $this->on(static::EVENT_BEFORE_SEND, [static::className(), 'beforeSend']);

    }
    //原理 .  需要原本返回json应该这样  format 设置成 FORMAT_JSON
    /*1. 创建response对象
            return \Yii::createObject([
                'class' => 'yii\web\Response',
                 'format' => \yii\web\Response::FORMAT_JSON,
                'data' => [
                 'message' => 'hello world',
                    'code' => 100,
            ],
            ]);
    // 2 现在直接修改了文件的配置
    在main的配置文件上修改response 指向当前文件
      'response' => [
            'class' => 'api\components\Response',
        ],
    */
    /**
     * 发送前格式化响应结果
     * @param object $event
     * 原来的信息
     * $response->data = [
     *      'success'=>''
     *          code =>''
     *         message =>''
     *          data =>''
     * ]
     *
     */
    public static function beforeSend($event)
    {
        $response = $event->sender;
        //处理返回
        if($response->isSuccessful){
            $response->data = [
                'code' => $response->getStatusCode(),
                'message' => $response->statusText,
                'data' => $response->data,
            ];

        }else{
            $code = $response->data['code'] ?? ErrorCode::EC_UNKNOWN;
            $message = $response->data['message'] ?? ErrorCode::errMsg($code);
            $response->statusCode = 200;
            $response->data = [
                'code' => $code,
                'msg'  => $message, //LanguageHelper::translation($message),多语言的话加上翻译
                'data' => YII_DEBUG==true?$response->data:null,
            ];
        }
/*
        $response->data = [
            'success' => $response->isSuccessful,
            'code' => $response->getStatusCode(),
            'message' => $response->statusText,
            'data' => $response->data,
        ];
        $response->statusCode = 200;*/
    }




}



?>