<?php
namespace api\helpers;
use yii\helpers\ArrayHelper;


class ErrorCode{
    const SUCCESS_CODE = 0;
    const EC_UNKNOWN = 102;  //未知错误
    const EC_SYSTEM_ERROR = 106;  //未知错误



    //并发操作
    const EC_SYSTEM_OPERATING = 107;


    //300~399 用户错误
    const EC_USER_INPUT =299;


    public static $errorDes = [
        self::EC_SYSTEM_OPERATING => '您的操作太过频繁,请稍后重试',

        self::EC_SYSTEM_ERROR=>'系统异常',



        self::EC_UNKNOWN => '未知错误',
        self::EC_USER_INPUT => '输入错误',

    ];


    /**
     * 根据错误码返回相应的错误信息
     * @param int $errCode
     * @return string
     */
    public static function errMsg($errCode)
    {
        return ArrayHelper::getValue(self::$errorDes,$errCode,self::$errorDes[self::EC_UNKNOWN]);
    }
}

?>