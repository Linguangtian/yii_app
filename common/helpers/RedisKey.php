<?php
namespace common\helpers;

class RedisKey{

    const EXPIRE_TIME = 3600; //默认缓存时间
    const BOOK_INFO = 'book_info_%s';
    const BOOK_TAGS_BOOK = 'book_tags_info_%s';
    const API_LOCK_PREFIX = 'api_lock_%s';


    public static function bookList($key){

        return sprintf(self::BOOK_INFO,$key);

    }



    public static function bookInfo($key){

        return sprintf(self::BOOK_INFO,$key);
    }


    public static function bookGatsInfo($key){

        return sprintf(self::BOOK_TAGS_BOOK,$key);
    }

    // 获取接口请求锁
    public static function getApiLockKey($route)
    {
        $key = $route;
        return sprintf(self::API_LOCK_PREFIX, $key);
    }


}

?>