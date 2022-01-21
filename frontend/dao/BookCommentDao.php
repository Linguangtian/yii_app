<?php
namespace frontend\dao;

use yii\base\Component;
use frontend\models\book\Book;
use frontend\data\ActiveDataProvider;

/*
 * dao  只管取数据
 *
 *
 * */

class BookCommentDao extends Component{


    /*
     * 获取书籍列表
     * 只执行查询数据库的操作
     *
     * */
    public function bookList(){
      $bookName =  Book::tableName();
      $dataProvider = new ActiveDataProvider([
            'query' => Book::find()->orderBy('id'),   //依赖容器注入
            'pagination'=>['PageSize'=>10]
      ]);


      //返回一个POST实例
      return $dataProvider->toArray();



    }



}





?>