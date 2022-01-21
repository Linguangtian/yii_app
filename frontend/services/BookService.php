<?php
namespace frontend\services;



use frontend\dao\BookCommentDao;

/**
 * 只管处理数据
 *
 **执行逻辑上的数组处理
 *
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


}