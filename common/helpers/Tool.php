<?php
namespace common\helpers;

class Tool
{


    /**
     * 批量根据key清除redis缓存
     * @param $key
     */
    public static function batchClearCache($key)
    {
        $redis = new RedisStore();
        $redis->delByPattern($key);
    }


    /**
     * 根据key清除redis缓存
     * @param $key
     */
    public static function clearCache($key)
    {
        $redis = new RedisStore();
        $redis->del($key);
    }



}


?>