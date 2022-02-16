<?php
namespace frontend\dao;

use common\helpers\RedisStore;
use yii\base\Component;
use frontend\models\book\Book;
use frontend\data\ActiveDataProvider;
use  yii\base\BaseObject;
use common\helpers\RedisKey;

/*
 * dao  只管取数据
 *
 *
 * */

class BookCommentDao extends BaseObject{


    /*
     * 获取书籍列表
     * 只执行查询数据库的操作
     *
     * */
    public function bookList(){

      $key =  RedisKey::bookList(132);
      $redis = new RedisStore();

      if ($data = $redis->get($key)) {
          return json_decode($data, true);
      }

      $bookName =  Book::tableName();
      $dataProvider = new ActiveDataProvider([
            'query' => Book::find()->orderBy('id'),   //依赖容器注入
            'pagination'=>['PageSize'=>10]
      ]);
      foreach ($dataProvider as $li){
          //原始数据的处理

      }
      //写入redis中
      $data = $dataProvider->toArray();
      $redis->setEx($key, json_encode($data));
      //返回一个POST实例
      return $data;
    }



}





?>