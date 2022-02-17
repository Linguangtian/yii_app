<?php

namespace api\controllers;
use api\exceptions\ApiException;
use api\helpers\ErrorCode;
use common\helpers\RedisKey;
use common\helpers\RedisStore;
use common\helpers\Tool;
use api\services\BookService;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\Controller;
use api\controllers\BaseController;

use Yii;  //需要引用   Yii::$app
/**
 * Site controller
 *
 * 使用restful 路由 /books 加S
 * get  提交index 列表 GET
 * get  /books/123详细用户 ->view
 * post  ->create
 * put   ->update
 * delete ->delete
 *
 * [
'PUT,PATCH users/<id>' => 'user/update',
'DELETE users/<id>' => 'user/delete',
'GET,HEAD users/<id>' => 'user/view',
'POST users' => 'user/create',
'GET,HEAD users' => 'user/index',
'users/<id>' => 'user/options',
'users' => 'user/options',
]
 *
 */
class Book2Controller extends ActiveController
{
 // public  $enableCsrfValidation=false;

   public $modelClass = 'api\models\book\Book';

    public $checkAccess =  'checkAccess';

      public function actions()
   {
        $ations =  parent::actions(); // TODO: Change the autogenerated stub
        unset($ations['index']);

        return $ations;
   }

    /**
     * 查看书籍列表
     * */
    public function actionIndex(){
        echo 211;exit;  //这里不会走
    }


    public function actionUpdate(){
        echo '这里会走checkAccess';

    }

// yii\rest\Controller::checkAccess() 方法 来执行授权检查，该方法会被yii\rest\ActiveController内置的操作调用。
    public function checkAccess($action, $model = null, $params = [])
    {
        //执行检测权限
       echo 333;exit;
    }

}
