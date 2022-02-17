<?php

namespace frontend\controllers;

use yii\web\Controller;
use Yii;  //需要引用   Yii::$app
use common\helpers\RedisKey;
use frontend\controllers\BaseController;
/**
 * redis测试
 */
class RedisTestController extends BaseController
{

    public function actionIndex(){
        //赋值 当成功时会返回布尔值
        $source = Yii::$app->redis->set('var1','asdasd');

       //获取键的值
        $source = Yii::$app->redis->get('var1');

        //删除键
        $var2 = Yii::$app->redis->keys("*");
    }






}
