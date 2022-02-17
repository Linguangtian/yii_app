<?php

namespace api\controllers;

use Yii;
use yii\web\Controller;

use api\controllers\BaseController;


use yii\filters\RateLimiter;

/**
 * Site controller
 */
class UserController  extends BaseController
{


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        # rate limit部分，速度的设置是在
        #   app\models\User::getRateLimit($request, $action)
        /*  官方文档：
            当速率限制被激活，默认情况下每个响应将包含以下HTTP头发送 目前的速率限制信息：
            X-Rate-Limit-Limit: 同一个时间段所允许的请求的最大数目;
            X-Rate-Limit-Remaining: 在当前时间段内剩余的请求的数量;
            X-Rate-Limit-Reset: 为了得到最大请求数所等待的秒数。
            你可以禁用这些头信息通过配置 yii\filters\RateLimiter::enableRateLimitHeaders 为false, 就像在上面的代码示例所示。
        */
        $behaviors['rateLimiter'] = [
            'class' => RateLimiter::className(),
            'enableRateLimitHeaders' => true,  //当前类开启限数
        ];
        return $behaviors;
    }



    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            $data=array(
                'message'=>'用户未登录',
            );
        }else{
            $data=array(
                'message'=>'用户已登录',
                'info'=>$this->_user
            );
        }
       return $data;
    }


    public function actionLogin(){

        echo '免登录访问!';exit;
    }

}
