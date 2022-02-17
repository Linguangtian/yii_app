<?php
namespace common\helpers;
use Yii;
use yii\base\BaseObject;
use yii\base\Component;

class RedisStore extends Component
{

    /*redis自带  的方法
        del  exits set setex  key incrby llen长度   HMSET批量设置哈希

    */

    public $redis;


    const API_EXPIRE_TIME = 300; //接口过期时间

    public function init()
    {
        parent::init();
        //默认redis实例
        $this->redis = Yii::$app->redis;
    }

    //----------------  string和通用方法 ---------------
    /**
     * 设置string缓存
     * @param $key
     * @param $value
     * @return bool
     */
    public function set($key, $value)
    {
        return $this->redis->set($key, $value);
    }

    /**
     * 设置string缓存同时设置过期时间
     * @param $key
     * @param $value
     * @param int $expire 过期时间,默认1小时
     * @return mixed
     */
    public function setEx($key, $value, $expire = self::API_EXPIRE_TIME)
    {
        return $this->redis->setex($key, $expire, $value);
    }

    /**
     * 获取string类型缓存
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->redis->get($key);
    }

    /**
     * 清除此key值下的数据
     * @param $key
     * @return bool
     */
    public function del($key)
    {
        return $this->redis->del($key);
    }



    /**
     * 匹配批量删除此key下所有的值,谨慎使用
     * @param $pattern
     * @throws \yii\db\Exception
     */
    public function delByPattern($pattern)
    {

        //获取所有key
        $keys = $this->getByPattern($pattern);

        //循环删除
        foreach ($keys as $key) {
            $this->del($key);
        }
    }


    /**
     * 根据前缀批量获取键名
     * @param $pattern
     * @return array|bool|null|string
     * @throws \yii\db\Exception
     */
    public function getByPattern($pattern)
    {
       // $key = $this->redis->keys($pattern . "*");
      //  $data =  $this->redis->executeCommand('KEYS', [$pattern . '*']);
        return $this->redis->executeCommand('KEYS', [$pattern . '*']);
    }




    //-------------- 哈希相关 --------------
    /**
     * 设置hash,单个field
     * @param string $key
     * @param string $field  字段
     * @param string $value  值
     * @return bool
     */
    public function hSet($key, $field, $value) {
        return $this->redis->HSET($key, $field, $value);
    }

    /**
     * 获取hash的field值
     * @param $key
     * @param $field
     * @return string
     */
    public function hGet($key, $field)
    {
        return $this->redis->HGET($key, $field);
    }




    //------------------ 并发锁相关 ------------------

    /**
     * 检测锁,有锁返回true
     * @param     $key
     * @param int $expire
     * @return bool
     */
    public function checkLock($key, $expire = 45)
    {
        if ($this->redis->exists($key)) {
            return true;
        }

        $this->setEx($key, 1, $expire);
        return false;
    }

    /**
     * 释放锁
     * @param $key
     * @return bool
     */
    public function releaseLock($key)
    {
        return $this->del($key);
    }

    /**
     * 脚本运行锁，设置过期时间为2小时
     * @param $key
     * @return bool
     */
    public function scriptLockCheck($key)
    {
        if ($this->exists($key)) {
            return true;
        }

        $this->setEx($key, 1,7200);
        return false;
    }

    /**
     * 脚本锁释放
     * @param $key
     * @return bool
     */
    public function scriptLockRelease($key)
    {
        return $this->del($key);
    }

}


?>