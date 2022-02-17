<?php
namespace api\dao;

use common\helpers\RedisStore;
use yii\base\Component;
use api\models\book\Book;
use api\data\ActiveDataProvider;
use  yii\base\BaseObject;
use common\helpers\RedisKey;
use api\dao\TraitDao;


/*
 * dao  只管取数据
 * */

class BookDao extends BaseObject{
    use TraitDao;
    private $_listFields = [
        'book_id', 'name', 'cover', 'author','author_cover', 'description', 'tag', 'total_chapters', 'finished', 'is_finished','last_chapter_id', 'category', 'language', 'total_views', 'hot_num',
    ];

    /**
     * 获取书籍信息
     * @param int $bookId
     * @param array $fileds
     * @return array|mixed
     */
    public function getBookInfo($bookId, $fields=[]){
        $key = RedisKey::bookInfo($bookId);
        $redis = new RedisStore();
        if($str_data = $redis->get($key) ){

            $data =  json_decode($str_data,true);

        }else{
            $book = Book::findOne(['id' => $bookId]);
            $data = $book?$book->toArray():null;
           $res = $redis->setEx($key, json_encode($data));

        }
        //过滤字段
        if($fields){
            $data = $this->dataFilter($data,$fields);
        }else{
         /*   $fields = $this->_listFields;
            $data = $this->dataFilter($data,$fields);*/  //过滤掉不想被显示的

        }
        return  $data;
    }










}





?>