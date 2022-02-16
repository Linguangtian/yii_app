<?php
namespace frontend\models\user;


class User extends \common\models\User
{


    // 状态常量
    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 2;

    public static function findByToken($token)
    {
        return User::findOne(['user_token'=> $token]);
    }
}