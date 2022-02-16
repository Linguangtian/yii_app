<?php
namespace frontend\services;



use api\exceptions\Exception;
use common\helpers\RedisKey;
use common\helpers\RedisStore;
use common\helpers\Tool;
use frontend\dao\BookCommentDao;
use frontend\models\book\Book;
use yii\base\ErrorException;

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

}