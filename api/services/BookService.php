<?php
namespace api\services;



use api\exceptions\Exception;
use common\helpers\RedisKey;
use common\helpers\RedisStore;
use common\helpers\Tool;
use api\dao\BookCommentDao;
use api\models\book\Book;
use yii\base\ErrorException;
use api\exceptions\ApiException;
use api\helpers\ErrorCode;

use api\dao\BookDao;
use  yii;
/**
 * 只管处理数据
 *
 **执行逻辑上的数组处理
 *
 *
 * 更新数据在这里
 *
 * 判断抛出异常也是在这里
 */
class BookService
{

    /**
     * 推荐位信息,返回标题和书籍数据
     * 推荐书籍列表
     * */
    public function recommentInfo(){

      $bookCommentDao =  new BookCommentDao();
      $list = $bookCommentDao->bookList();

      foreach ($list['list'] as $key=>$li){
          //数组处理
            if( $li['id'] == 87 ){
                unset($list['list'][$key]);
            }
      }
      return [
          'list' => $list,
          'title'=> '书籍排名前几的'
      ];

    }

    /**
     * 更新书籍
     *
     * 清空相关的redis
     *
     * 异常返回报错机制
     *
     * */

    public function bookUpdate($id){

        $book = Book::findOne($id );

        if(!$book){
            throw new ErrorException('错误');  //这里需要重写,反馈
        }
        $book->name = 'gaiming';
        $book ->save();
        $key =  sprintf(RedisKey::BOOK_INFO, '');


        // 批量清除缓存
        Tool::batchClearCache($key); // 清理banner的缓存
        //实际执行的是
        $redis = new RedisStore();
        $redis->delByPattern($key);
        return [];
    }


    /**
     * 创建书籍
     *
     */
    public function bookCreate(){
      //  $book = new Book;
       // $book = Book::findOne(['id' => 87]);
        //$book->load(Yii::$app->request->post()); //批量赋值
        $data = Yii::$app->request->post();
     /*   foreach ($data['book'] as $key=>$value){
            $book->$key = $value;
        }*/

        $data = [
            'Book' => [
                "channel_id"=>'ssjafnkl阿萨NHK临时搭建',
                "cid"=>'ssklkl',
                "name"=>"测试小说",
                "note_name"=>"测试old_name",
                "source"=>"测试old_name",
                "source_id"=>1,
                "author"=>"测试old_name",
                "description"=>"测试old_name",
                "keywords"=>"测试old_name",
                "total_price"=>6,
                "words_price"=>6,
                "chapter_price"=>6,
                "free_chapters"=>6,
                "cover"=>"555",
                "status"=>6,
                "online_status"=>6,
                "weight"=>6,
                "is_vip"=>6,
                "is_baoyue"=>6,
                "is_hot"=>6,
                "is_new"=>6,
                "is_yy"=>6,
                "is_god"=>6,
                "total_words"=>6,
                "total_chapters"=>6,
                "total_views"=>6,
                "total_favors"=>6,
                "last_chapter_id"=>6,
                "last_chapter_time"=>6,
                "chapter_update_remind"=>6,
                "audio_id"=>6,
                "store_type"=>6,
                "lang_id"=>6,
                "created_at"=>6,
                "updated_at"=>6,
                "deleted_at"=>6
            ]
        ];
        //批量赋值
        $book = new Book();
        $book->load($data);
        if( !$book->validate()){ // 进行验证


        // var_dump($book->getErrors());exit;
          //  throw new ApiException(ErrorCode::EC_USER_INPUT);
            throw new Exception();
            //$book->getErrors()


        }
     //   echo \yii\helpers\Html::error($book,'channel_id',)
       if( $book->save() ){
           return $book;
       }else{
           return  false;
       }

    }



    /**
     *查看书籍详情
     * @param $id 书籍ID
     */
    public function bookInfo($id){
      //这里是逻辑层,要去dao层获取数据
      $bookDao = new BookDao();
      $book = $bookDao->getBookInfo($id);
      // $info =  Book::findOne($id);
      return $book;
    }


    /**
     * 更新书籍
     * @param $id 书籍id
     * @param $data 更新数组
     * */
    public function bookUpdate2($id){


    }








}