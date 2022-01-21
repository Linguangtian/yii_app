<?php

namespace frontend\controllers;
use frontend\services\BookService;
use yii\web\Controller;

/**
 * Site controller
 */
class BookController extends Controller
{
    /**
     * 查看书籍列表
     * */
    public function actionIndex(){
        $bookService = new BookService();
        return $bookService->recommentInfo();
    }






}
