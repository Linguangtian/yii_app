<?php

namespace api\controllers;

use api\services\BookService;

use yii\web\Controller;
use  yii\helpers\Url;

use Yii;  //需要引用   Yii::$app

class UrlController extends Controller
{

    public function actionIndex(){
        //url助手

        echo \yii\helpers\Url::home();
        $absoluteHomeUrl = Url::home(true);
        $httpsAbsoluteHomeUrl = Url::home('https');

        //创建URL
        $url = Url::toRoute(['product/view', 'id' => 42]);
        Url::toRoute(['site/index', 'param1' => 'value1', 'param2' => 'value2']);

        //检查URL是否存在
        $isRelative = Url::isRelative('test/it');


       // 数组助手
        //获取不存在的值
        $array=['k0'=>1,'k2'=>2,'k3'=>['j0'=>1]];
        \yii\helpers\ArrayHelper::getValue($array, 'k1','1');

        //设定值
        ArrayHelper::setValue($array, ['k3', 'j0'], 2);

        //删除指定
        $array = ['type' => 'A', 'options' => [1, 2]];
        $type = ArrayHelper::remove($array, 'type');

        //获取所有ID
        $data = [
            ['id' => '123', 'data' => 'abc'],
            ['id' => '345', 'data' => 'def'],
        ];
        $ids = ArrayHelper::getColumn($array, 'id');

    }



}
