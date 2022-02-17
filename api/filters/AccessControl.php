<?php
namespace api\filters;


use Yii;

/**
 * 访问控制
 */
class AccessControl extends \yii\filters\AccessControl
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $route = Yii::$app->controller->route;
        $loginAccess = Yii::$app->params['login_access'];


        //查询用户
        $userUid = Yii::$app->user->id;

        if (!$userUid) { // 无效的token
          echo '无效的token';exit;
        }

        return true;
    }
}
