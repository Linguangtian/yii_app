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
class BookController extends Controller
{
  public  $enableCsrfValidation=false;
    /**
     * 查看书籍列表
     * */
    public function actionIndex(){
        /*抛出的异常和错误形式都是一样的*/
        //throw new ErrorException('错误');
        ///throw new Exception('错误');
        //  $body = @file_get_contents('php://input');
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


    /**
     * 创建书籍
     * method POST
     * @param $data 创建数据
     *
     * */
    public function actionCreate(){
        $bookService = new BookService();
        return $bookService->bookCreate();
    }

    /**
     * 书籍详细
     * method get
     * @param $id 书籍
     * */
    public function actionView($id){
        $bookService = new BookService();
        return $bookService->bookInfo($id);
    }

    /**
     *更新书籍
     * method put+/id
     *
     */
    public function actionUpdate($id){
        $bookService = new BookService();
        return $bookService->bookUpdate($id);
    }



    /**
     * 删除书籍
     * method delete + id
     * */
    public function actionDelete($id){


    }


    /**
     * 批量模糊清理redis缓存
     * */
    public function actionBatchClearRedis(){
        Tool::batchClearCache(sprintf(RedisKey::BOOK_INFO, '')); // 书籍缓存
        Tool::batchClearCache(sprintf(RedisKey::BOOK_TAGS_BOOK, '')); // 标签书籍

    }

    /**清楚固定的
     * @param $id  书籍id
     *
     * */

    public function actionClearRedis(  $id = 89){
        $key = RedisKey::bookInfo($id);
        Tool::clearCache($key);

        return true;
        //为什么不直接调用实例化redis    接口隔离
        $redis =  new redis();
        $redis->del($key);
    }


    /**
     * 计划任务添加锁事情
     *
     * */
    public function actionPlanTask(){

        //
        /*这里不做逻辑处理
         * 应该写在 BookService
         * 现在测试写在控制层
         * */
        //文件锁
        $key =RedisKey::getApiLockKey('book/plan-task');

        $redis = new RedisStore();
        //验证 checkLock 不存在保存为redis
        if ($redis->checkLock($key)) {

            throw new ApiException(ErrorCode::EC_SYSTEM_OPERATING);
        }

        //如计划任务每5分钟抓一次数据,但是5分钟前一个脚本直接抓取还未结束 就禁止执行现在这个
        echo '开始处理业务逻辑, 如脚本上传书籍,或者开始抓取数据';

        echo '结束';
        //释放锁
        $redis->releaseLock($key);

    }


}
