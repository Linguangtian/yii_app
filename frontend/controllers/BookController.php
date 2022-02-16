<?php

namespace frontend\controllers;
use common\helpers\RedisKey;
use common\helpers\RedisStore;
use common\helpers\Tool;
use frontend\services\BookService;
use yii\web\Controller;
use frontend\controllers\BaseController;

use Yii;  //需要引用   Yii::$app
/**
 * Site controller
 */
class BookController extends Controller
{
  public  $enableCsrfValidation=false;
    /**
     * 查看书籍列表
     * */
    public function actionIndex(){
      //  $body = @file_get_contents('php://input');



        $data = Yii::$app->request->post();

        var_dump($data);exit;

        exit;

        $bookService = new BookService();
        return $bookService->recommentInfo();
    }

    /**
     * 更新书籍 并清除redis
     * */
    public function actionIndex2(){
        $id = 99 ;
        $bookService = new BookService();
        return $bookService->bookUpdate($id);


    }






}
